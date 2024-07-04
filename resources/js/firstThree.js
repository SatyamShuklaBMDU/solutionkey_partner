import * as THREE from 'three';

const canvas = document.getElementById('hoverCanvas');
const scene = new THREE.Scene();
const camera = new THREE.PerspectiveCamera(53, window.innerWidth / window.innerHeight, 0.1, 10000);
const renderer = new THREE.WebGLRenderer({ canvas: canvas, alpha: true });
renderer.setSize(window.innerWidth, window.innerHeight);

// Circle geometry
const circleGeometry = new THREE.CircleGeometry(0.2, 32);
const circleMaterial = new THREE.MeshBasicMaterial({ color: 0xffffff, opacity: 0.5, transparent: true });
const circle = new THREE.Mesh(circleGeometry, circleMaterial);
scene.add(circle);

// Position camera
camera.position.z = 5;

// Mouse move listener
document.addEventListener('mousemove', (event) => {
    const mouseX = (event.clientX / window.innerWidth) * 2 - 1;
    const mouseY = - (event.clientY / window.innerHeight) * 2 + 1;
    circle.position.x = mouseX * 5; // Scale factor to adjust the movement
    circle.position.y = mouseY * 5; // Scale factor to adjust the movement
});

// Window resize listener
window.addEventListener('resize', () => {
    camera.aspect = window.innerWidth / window.innerHeight;
    camera.updateProjectionMatrix();
    renderer.setSize(window.innerWidth, window.innerHeight);
});

// Animation loop
const animate = function () {
    requestAnimationFrame(animate);
    renderer.render(scene, camera);
};

animate();