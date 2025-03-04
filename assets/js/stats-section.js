document.addEventListener("DOMContentLoaded", () => {
  // Animated Numbers
  const animateValue = (id, start, end, duration) => {
    let range = end - start;
    let current = start;
    let increment = Math.ceil(range / (duration / 100)); // Calculate increment to fit the duration
    const obj = document.getElementById(id);
    let timer = setInterval(() => {
      current += increment;
      if ((increment > 0 && current >= end) || (increment < 0 && current <= end)) {
        current = end; // Ensure it stops exactly at the end value
        clearInterval(timer);
      }
      obj.textContent = current.toLocaleString(); // Format number with commas
    }, 50); // Set the step time to 50ms for smooth animation
  };

  // Trigger animations when scrolling
  let animated = false;
  window.addEventListener("scroll", () => {
    const statsSection = document.querySelector(".stats-section");
    const statsOffset = statsSection.offsetTop;
    if (!animated && window.scrollY + window.innerHeight > statsOffset) {
      animateValue("developer-count", 0, 253, 10000); // Complete in 5 seconds
      animateValue("project-count", 0, 1038, 10000); // Complete in 5 seconds
      animateValue("house-count", 0, 3669, 10000); // Complete in 5 seconds
      animated = true;
    }
  });
});
