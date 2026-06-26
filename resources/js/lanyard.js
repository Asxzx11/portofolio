import * as THREE from 'three';

const CARD_W = 1.2;
const CARD_H = 1.55;
const CARD_DEPTH = 0.025;
const PHOTO_W = CARD_W * 0.94;
const PHOTO_H = CARD_H * 0.82;
const STRAP_END_OFFSET = 0.48;
const ANCHOR_Y = 2.8;
const ROPE_SEGMENTS = 14;
const STRAP_WIDTH = 0.095;
const STRAP_THICKNESS = 0.014;
const STRAP_GAP = 0.028;

function createStrapTexture() {
    const canvas = document.createElement('canvas');
    canvas.width = 64;
    canvas.height = 512;
    const ctx = canvas.getContext('2d');

    ctx.fillStyle = '#f8fafc';
    ctx.fillRect(0, 0, 64, 512);

    ctx.strokeStyle = 'rgba(226, 232, 240, 0.9)';
    ctx.lineWidth = 1;
    for (let y = 0; y < 512; y += 6) {
        ctx.beginPath();
        ctx.moveTo(0, y);
        ctx.lineTo(64, y);
        ctx.stroke();
    }

    ctx.strokeStyle = 'rgba(203, 213, 225, 0.55)';
    ctx.lineWidth = 1.5;
    ctx.strokeRect(2, 2, 60, 508);

    const texture = new THREE.CanvasTexture(canvas);
    texture.wrapS = THREE.RepeatWrapping;
    texture.wrapT = THREE.RepeatWrapping;
    texture.repeat.set(1, 3);
    texture.colorSpace = THREE.SRGBColorSpace;
    return texture;
}

function buildFlatStrapGeometry(points, width, thickness, xOffset = 0) {
    const geometries = [];
    const up = new THREE.Vector3(0, 0, 1);

    for (let i = 0; i < points.length - 1; i++) {
        const start = points[i].clone();
        const end = points[i + 1].clone();
        start.x += xOffset;
        end.x += xOffset;

        const direction = new THREE.Vector3().subVectors(end, start);
        const length = direction.length();
        if (length < 0.0001) continue;

        direction.normalize();
        const right = new THREE.Vector3().crossVectors(direction, up);
        if (right.lengthSq() < 0.0001) {
            right.set(1, 0, 0);
        } else {
            right.normalize();
        }

        const center = new THREE.Vector3().addVectors(start, end).multiplyScalar(0.5);
        const geo = new THREE.BoxGeometry(width, length, thickness);
        const matrix = new THREE.Matrix4();
        matrix.makeBasis(right, direction, up);
        matrix.setPosition(center);
        geo.applyMatrix4(matrix);
        geometries.push(geo);
    }

    if (geometries.length === 0) {
        return new THREE.BoxGeometry(width, 0.1, thickness);
    }

    return mergeGeometries(geometries);
}

function mergeGeometries(geometries) {
    let totalVertices = 0;
    let totalIndices = 0;

    for (const geo of geometries) {
        totalVertices += geo.attributes.position.count;
        totalIndices += geo.index ? geo.index.count : geo.attributes.position.count;
    }

    const positions = new Float32Array(totalVertices * 3);
    const normals = new Float32Array(totalVertices * 3);
    const uvs = new Float32Array(totalVertices * 2);
    const indices = [];

    let vertexOffset = 0;

    for (const geo of geometries) {
        const pos = geo.attributes.position.array;
        const norm = geo.attributes.normal.array;
        const uv = geo.attributes.uv?.array;

        positions.set(pos, vertexOffset * 3);
        normals.set(norm, vertexOffset * 3);
        if (uv) uvs.set(uv, vertexOffset * 2);

        if (geo.index) {
            for (let i = 0; i < geo.index.count; i++) {
                indices.push(geo.index.array[i] + vertexOffset);
            }
        } else {
            for (let i = 0; i < geo.attributes.position.count; i++) {
                indices.push(vertexOffset + i);
            }
        }

        vertexOffset += geo.attributes.position.count;
        geo.dispose();
    }

    const merged = new THREE.BufferGeometry();
    merged.setAttribute('position', new THREE.BufferAttribute(positions, 3));
    merged.setAttribute('normal', new THREE.BufferAttribute(normals, 3));
    merged.setAttribute('uv', new THREE.BufferAttribute(uvs, 2));
    merged.setIndex(indices);
    return merged;
}

function createBuckle() {
    const group = new THREE.Group();
    const plasticMat = new THREE.MeshStandardMaterial({
        color: 0x9ca3af,
        roughness: 0.55,
        metalness: 0.05,
    });

    const topPart = new THREE.Mesh(
        new THREE.BoxGeometry(0.2, 0.07, 0.035),
        plasticMat,
    );
    group.add(topPart);

    const bottomPart = new THREE.Mesh(
        new THREE.BoxGeometry(0.17, 0.055, 0.04),
        plasticMat,
    );
    bottomPart.position.y = -0.05;
    group.add(bottomPart);

    const slot = new THREE.Mesh(
        new THREE.BoxGeometry(0.11, 0.018, 0.045),
        new THREE.MeshStandardMaterial({ color: 0x6b7280, roughness: 0.7 }),
    );
    slot.position.y = -0.022;
    group.add(slot);

    return group;
}

function createHookRing() {
    const group = new THREE.Group();
    const metalMat = new THREE.MeshStandardMaterial({
        color: 0x64748b,
        roughness: 0.22,
        metalness: 0.92,
    });

    const ring = new THREE.Mesh(
        new THREE.TorusGeometry(0.05, 0.011, 10, 24),
        metalMat,
    );
    ring.rotation.y = Math.PI / 2;
    group.add(ring);

    const hook = new THREE.Mesh(
        new THREE.TorusGeometry(0.028, 0.008, 8, 16, Math.PI * 1.2),
        metalMat,
    );
    hook.rotation.z = Math.PI * 0.15;
    hook.position.set(0.04, -0.04, 0);
    group.add(hook);

    return group;
}

export function initLanyard(container) {
    const photoUrl = container.dataset.photo;
    if (!photoUrl) return;

    const canvas = document.createElement('canvas');
    canvas.className = 'h-full w-full cursor-grab touch-none active:cursor-grabbing';
    container.appendChild(canvas);

    const renderer = new THREE.WebGLRenderer({
        canvas,
        alpha: true,
        antialias: true,
    });
    renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2.5));
    renderer.outputColorSpace = THREE.SRGBColorSpace;
    renderer.shadowMap.enabled = true;
    renderer.shadowMap.type = THREE.PCFSoftShadowMap;

    const scene = new THREE.Scene();

    const camera = new THREE.PerspectiveCamera(38, 1, 0.1, 100);
    camera.position.set(0, 0.55, 4.1);
    camera.lookAt(0, 0.15, 0);

    scene.add(new THREE.AmbientLight(0xffffff, 0.65));

    const keyLight = new THREE.DirectionalLight(0xffffff, 1.1);
    keyLight.position.set(3, 5, 4);
    keyLight.castShadow = true;
    scene.add(keyLight);

    const fillLight = new THREE.DirectionalLight(0x93c5fd, 0.45);
    fillLight.position.set(-4, 1, 2);
    scene.add(fillLight);

    const cardGroup = new THREE.Group();
    scene.add(cardGroup);

    const cardMat = new THREE.MeshStandardMaterial({
        color: 0xffffff,
        roughness: 0.35,
        metalness: 0.05,
    });

    const cardBody = new THREE.Mesh(
        new THREE.BoxGeometry(CARD_W, CARD_H, CARD_DEPTH),
        cardMat,
    );
    cardBody.castShadow = true;
    cardBody.receiveShadow = true;
    cardGroup.add(cardBody);

    const photoMat = new THREE.MeshStandardMaterial({
        roughness: 0.15,
        metalness: 0,
    });
    const photoPlane = new THREE.Mesh(
        new THREE.PlaneGeometry(PHOTO_W, PHOTO_H),
        photoMat,
    );
    photoPlane.position.set(0, 0.2, CARD_DEPTH / 2 + 0.001);
    cardGroup.add(photoPlane);

    const clipMat = new THREE.MeshStandardMaterial({
        color: 0xc0c4cc,
        roughness: 0.25,
        metalness: 0.85,
    });
    const clip = new THREE.Mesh(
        new THREE.BoxGeometry(0.18, 0.05, 0.045),
        clipMat,
    );
    clip.position.set(0, CARD_H / 2 + 0.03, 0);
    cardGroup.add(clip);

    const nameCanvas = document.createElement('canvas');
    nameCanvas.width = 512;
    nameCanvas.height = 128;
    const nameCtx = nameCanvas.getContext('2d');
    nameCtx.fillStyle = '#0f172a';
    nameCtx.fillRect(0, 0, 512, 128);
    nameCtx.fillStyle = '#ffffff';
    nameCtx.font = 'bold 42px "Instrument Sans", system-ui, sans-serif';
    nameCtx.textAlign = 'center';
    nameCtx.textBaseline = 'middle';
    nameCtx.fillText('Agung Setiawan', 256, 52);
    nameCtx.fillStyle = '#94a3b8';
    nameCtx.font = '24px "Instrument Sans", system-ui, sans-serif';
    nameCtx.fillText('Web Developer', 256, 96);

    const nameStrip = new THREE.Mesh(
        new THREE.PlaneGeometry(CARD_W * 0.94, CARD_H * 0.12),
        new THREE.MeshStandardMaterial({
            map: new THREE.CanvasTexture(nameCanvas),
            roughness: 0.6,
        }),
    );
    nameStrip.position.set(0, -CARD_H * 0.38, CARD_DEPTH / 2 + 0.001);
    cardGroup.add(nameStrip);

    const loader = new THREE.TextureLoader();
    loader.load(photoUrl, (texture) => {
        texture.colorSpace = THREE.SRGBColorSpace;
        texture.anisotropy = renderer.capabilities.getMaxAnisotropy();
        texture.minFilter = THREE.LinearMipmapLinearFilter;
        texture.magFilter = THREE.LinearFilter;
        texture.generateMipmaps = true;
        photoMat.map = texture;
        photoMat.needsUpdate = true;
    });

    const ropePoints = Array.from({ length: ROPE_SEGMENTS + 1 }, (_, i) => ({
        x: 0,
        y: ANCHOR_Y - (i / ROPE_SEGMENTS) * (ANCHOR_Y - 0.5),
        z: 0,
        ox: 0,
        oy: 0,
        oz: 0,
        pinned: i === 0,
    }));

    const strapMat = new THREE.MeshStandardMaterial({
        color: 0xffffff,
        map: createStrapTexture(),
        roughness: 0.82,
        metalness: 0,
        side: THREE.DoubleSide,
    });

    const strapLeft = new THREE.Mesh(new THREE.BoxGeometry(0.1, 0.1, 0.01), strapMat);
    const strapRight = new THREE.Mesh(new THREE.BoxGeometry(0.1, 0.1, 0.01), strapMat);
    scene.add(strapLeft, strapRight);

    const buckle = createBuckle();
    scene.add(buckle);

    const hookRing = createHookRing();
    scene.add(hookRing);

    const connectorStrap = new THREE.Mesh(new THREE.BoxGeometry(0.1, 0.1, 0.01), strapMat);
    scene.add(connectorStrap);

    const anchorBar = new THREE.Mesh(
        new THREE.BoxGeometry(0.28, 0.035, 0.02),
        new THREE.MeshStandardMaterial({ color: 0xe2e8f0, roughness: 0.5, metalness: 0.15 }),
    );
    anchorBar.position.set(0, ANCHOR_Y + 0.02, 0);
    scene.add(anchorBar);

    const cardState = {
        x: 0,
        y: 0.2,
        z: 0,
        vx: 0,
        vy: 0,
        vz: 0,
        rotX: 0,
        rotY: 0,
        rotZ: 0,
        vRotX: 0,
        vRotY: 0,
        vRotZ: 0,
    };

    const drag = {
        active: false,
        pointerId: null,
        plane: new THREE.Plane(new THREE.Vector3(0, 0, 1), 0),
        offset: new THREE.Vector3(),
    };

    const raycaster = new THREE.Raycaster();
    const pointer = new THREE.Vector2();
    const hitMesh = new THREE.Mesh(
        new THREE.BoxGeometry(CARD_W * 1.1, CARD_H * 1.15, CARD_DEPTH * 3),
        new THREE.MeshBasicMaterial({ visible: false }),
    );
    cardGroup.add(hitMesh);

    function resize() {
        const { width, height } = container.getBoundingClientRect();
        if (width === 0 || height === 0) return;
        renderer.setSize(width, height, false);
        camera.aspect = width / height;
        camera.updateProjectionMatrix();
    }

    function pointerToNdc(event) {
        const rect = canvas.getBoundingClientRect();
        pointer.x = ((event.clientX - rect.left) / rect.width) * 2 - 1;
        pointer.y = -((event.clientY - rect.top) / rect.height) * 2 + 1;
    }

    function intersectCard() {
        raycaster.setFromCamera(pointer, camera);
        const hits = raycaster.intersectObject(hitMesh, false);
        return hits[0] ?? null;
    }

    function worldFromPointer(event) {
        pointerToNdc(event);
        raycaster.setFromCamera(pointer, camera);
        const point = new THREE.Vector3();
        raycaster.ray.intersectPlane(drag.plane, point);
        return point;
    }

    function onPointerDown(event) {
        pointerToNdc(event);
        const hit = intersectCard();
        if (!hit) return;

        drag.active = true;
        drag.pointerId = event.pointerId;
        canvas.setPointerCapture(event.pointerId);

        const world = worldFromPointer(event);
        drag.offset.set(
            cardState.x - world.x,
            cardState.y - world.y,
            cardState.z - world.z,
        );
    }

    function onPointerMove(event) {
        if (!drag.active || event.pointerId !== drag.pointerId) return;

        const world = worldFromPointer(event);
        cardState.x = world.x + drag.offset.x;
        cardState.y = world.y + drag.offset.y;
        cardState.z = world.z + drag.offset.z;

        cardState.vRotY = (event.movementX || 0) * 0.004;
        cardState.vRotX = -(event.movementY || 0) * 0.004;
    }

    function onPointerUp(event) {
        if (event.pointerId !== drag.pointerId) return;
        drag.active = false;
        drag.pointerId = null;
        canvas.releasePointerCapture(event.pointerId);
    }

    canvas.addEventListener('pointerdown', onPointerDown);
    canvas.addEventListener('pointermove', onPointerMove);
    canvas.addEventListener('pointerup', onPointerUp);
    canvas.addEventListener('pointercancel', onPointerUp);

    const restY = 0.2;
    const gravity = -0.0018;
    const damping = 0.965;
    const rotDamping = 0.92;
    const spring = 0.018;
    const rotSpring = 0.06;

    function getStrapAnchor() {
        return new THREE.Vector3(
            cardState.x,
            cardState.y + CARD_H / 2 + STRAP_END_OFFSET,
            cardState.z,
        );
    }

    function getCardClipY() {
        return cardState.y + CARD_H / 2 + 0.03;
    }

    function simulateRope() {
        const strapAnchor = getStrapAnchor();

        ropePoints[ROPE_SEGMENTS].x = strapAnchor.x;
        ropePoints[ROPE_SEGMENTS].y = strapAnchor.y;
        ropePoints[ROPE_SEGMENTS].z = strapAnchor.z;

        for (const p of ropePoints) {
            if (p.pinned) {
                p.x = 0;
                p.y = ANCHOR_Y;
                p.z = 0;
                continue;
            }

            const velX = (p.x - p.ox) * damping;
            const velY = (p.y - p.oy) * damping;
            const velZ = (p.z - p.oz) * damping;

            p.ox = p.x;
            p.oy = p.y;
            p.oz = p.z;

            p.x += velX;
            p.y += velY + gravity;
            p.z += velZ;
        }

        const segLen = (ANCHOR_Y - restY) / ROPE_SEGMENTS;

        for (let iter = 0; iter < 6; iter++) {
            for (let i = 0; i < ROPE_SEGMENTS; i++) {
                const a = ropePoints[i];
                const b = ropePoints[i + 1];

                const dx = b.x - a.x;
                const dy = b.y - a.y;
                const dz = b.z - a.z;
                const dist = Math.sqrt(dx * dx + dy * dy + dz * dz) || 0.0001;
                const diff = (dist - segLen) / dist;
                const offsetX = dx * diff * 0.5;
                const offsetY = dy * diff * 0.5;
                const offsetZ = dz * diff * 0.5;

                if (!a.pinned) {
                    a.x += offsetX;
                    a.y += offsetY;
                    a.z += offsetZ;
                }
                if (i + 1 < ROPE_SEGMENTS) {
                    b.x -= offsetX;
                    b.y -= offsetY;
                    b.z -= offsetZ;
                }
            }

            ropePoints[ROPE_SEGMENTS].x = strapAnchor.x;
            ropePoints[ROPE_SEGMENTS].y = strapAnchor.y;
            ropePoints[ROPE_SEGMENTS].z = strapAnchor.z;
        }
    }

    function updateStrapMesh() {
        const strapAnchor = getStrapAnchor();
        const cardClipY = getCardClipY();
        const points = ropePoints.map((p) => new THREE.Vector3(p.x, p.y, p.z));

        const upperPoints = points.filter((p) => p.y >= cardClipY - 0.02);
        if (upperPoints.length < 2) {
            upperPoints.unshift(new THREE.Vector3(strapAnchor.x, strapAnchor.y, strapAnchor.z));
            upperPoints.unshift(new THREE.Vector3(strapAnchor.x, ANCHOR_Y, strapAnchor.z));
        }

        strapLeft.geometry.dispose();
        strapRight.geometry.dispose();
        strapLeft.geometry = buildFlatStrapGeometry(upperPoints, STRAP_WIDTH, STRAP_THICKNESS, -STRAP_GAP / 2);
        strapRight.geometry = buildFlatStrapGeometry(upperPoints, STRAP_WIDTH, STRAP_THICKNESS, STRAP_GAP / 2);

        const buckleIndex = Math.max(2, Math.floor(ROPE_SEGMENTS * 0.68));
        const bucklePoint = ropePoints[buckleIndex];
        buckle.position.set(bucklePoint.x, bucklePoint.y, bucklePoint.z - 0.04);
        buckle.visible = bucklePoint.y > cardClipY + 0.15;

        hookRing.position.set(strapAnchor.x, strapAnchor.y - 0.07, strapAnchor.z - 0.03);

        const connectorVectors = [
            new THREE.Vector3(strapAnchor.x, strapAnchor.y - 0.12, strapAnchor.z),
            new THREE.Vector3(cardState.x, cardClipY, cardState.z),
        ];
        connectorStrap.geometry.dispose();
        connectorStrap.geometry = buildFlatStrapGeometry(connectorVectors, STRAP_WIDTH * 1.6, STRAP_THICKNESS, 0);
    }

    function updateCard(dt) {
        if (!drag.active) {
            cardState.vx += (0 - cardState.x) * spring;
            cardState.vy += (restY - cardState.y) * spring;
            cardState.vz += (0 - cardState.z) * spring;

            cardState.vx *= damping;
            cardState.vy *= damping;
            cardState.vz *= damping;

            cardState.x += cardState.vx;
            cardState.y += cardState.vy;
            cardState.z += cardState.vz;

            cardState.vRotX += (0 - cardState.rotX) * rotSpring;
            cardState.vRotY += (0 - cardState.rotY) * rotSpring;
            cardState.vRotZ += (0 - cardState.rotZ) * rotSpring;

            cardState.vRotX *= rotDamping;
            cardState.vRotY *= rotDamping;
            cardState.vRotZ *= rotDamping;
        } else {
            cardState.vx = 0;
            cardState.vy = 0;
            cardState.vz = 0;
        }

        cardState.rotX += cardState.vRotX;
        cardState.rotY += cardState.vRotY;
        cardState.rotZ += cardState.vRotZ;

        const sway = Math.sin(performance.now() * 0.001) * 0.015;
        cardGroup.position.set(cardState.x, cardState.y, cardState.z);
        cardGroup.rotation.set(
            cardState.rotX + sway * 0.3,
            cardState.rotY,
            cardState.rotZ + sway,
        );
    }

    const clock = new THREE.Clock();
    let frameId;

    function animate() {
        frameId = requestAnimationFrame(animate);
        clock.getDelta();

        simulateRope();
        updateCard();
        updateStrapMesh();

        renderer.render(scene, camera);
    }

    resize();
    window.addEventListener('resize', resize);
    animate();

    return () => {
        cancelAnimationFrame(frameId);
        window.removeEventListener('resize', resize);
        canvas.removeEventListener('pointerdown', onPointerDown);
        canvas.removeEventListener('pointermove', onPointerMove);
        canvas.removeEventListener('pointerup', onPointerUp);
        canvas.removeEventListener('pointercancel', onPointerUp);
        renderer.dispose();
    };
}
