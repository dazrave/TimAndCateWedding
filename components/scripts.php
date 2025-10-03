<!-- Scripts -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
<script>
    // Initialise AOS (Animate On Scroll)
    AOS.init({
        duration: 800,
        easing: 'ease-in-out',
        once: true
    });

    // Replace icons with Feather
    feather.replace({ 'stroke-width': 2 }); 
</script>

<script>
  function toggleDetails(id) {
    const el = document.getElementById(id);
    el.classList.toggle('hidden');
    el.classList.toggle('animate-fadeIn');
  }
</script>

<style>
  @keyframes fadeIn {
    from { opacity: 0; transform: translateY(-5px); }
    to { opacity: 1; transform: translateY(0); }
  }
  .animate-fadeIn {
    animation: fadeIn 0.3s ease-out forwards;
  }
</style>