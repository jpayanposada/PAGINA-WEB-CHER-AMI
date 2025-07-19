<!-- Botón flotante de redes sociales con despliegue -->
<style>
#social-float-btn {
    position: fixed;
    bottom: 100px; /* <-- aquí ajustas la distancia */
    right: 30px;
    z-index: 9999;
    background: rgba(207,142,148,1);
    color: #fff;
    width: 48px;
    height: 48px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 2px 8px rgba(0,0,0,0.15);
    font-size: 1.7rem;
    cursor: pointer;
    transition: background 0.2s;
    border: none;
}
#social-float-btn:hover {
    background: rgba(207,120,120,1);
}
#social-float-list {
    position: fixed;
    bottom: 210px; /* <-- también ajusta aquí, debe ser mayor que el botón */
    right: 30px;
    display: flex;
    flex-direction: column;
    gap: 12px;
    opacity: 0;
    pointer-events: none;
    transition: opacity 0.3s;
    z-index: 9999;
}
#social-float-list.show {
    opacity: 1;
    pointer-events: auto;
}
#social-float-list a {
    width: 44px;
    height: 44px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #fff;
    color: rgba(207,142,148,1);
    font-size: 1.4rem;
    box-shadow: 0 2px 8px rgba(0,0,0,0.15);
    transition: transform 0.2s;
    text-decoration: none;
}
#social-float-list a i {
    color: rgb(0, 0, 0) !important;
}
#social-float-list a.whatsapp { background: #25D366; }
#social-float-list a.instagram { background: linear-gradient(45deg, #fd5949, #d6249f, #285AEB); }
#social-float-list a.facebook { background: #1877f3; }
</style>

<button id="social-float-btn" title="Redes sociales">
    <i class="fas fa-share-alt"></i>
</button>
<div id="social-float-list">
    <a href="https://wa.me/57321654987" target="_blank" class="icon-minimalista">
        <i class="fab fa-whatsapp"></i>
    </a>
    <a href="https://instagram.com/tuusuario" target="_blank" class="icon-minimalista">
        <i class="fab fa-instagram"></i>
    </a>
    <a href="https://facebook.com/tuusuario" target="_blank" class="icon-minimalista">
        <i class="fab fa-facebook"></i>
    </a>
</div>
<script>
const btn = document.getElementById('social-float-btn');
const list = document.getElementById('social-float-list');
btn.addEventListener('click', function() {
    list.classList.toggle('show');
});
// Opcional: Ocultar al hacer clic fuera
document.addEventListener('click', function(e) {
    if (!btn.contains(e.target) && !list.contains(e.target)) {
        list.classList.remove('show');
    }
});
</script>