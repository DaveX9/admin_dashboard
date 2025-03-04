function filterFAQ(category) {
    // Remove active class from all menu items
    document.querySelectorAll('.faq-menu li').forEach(li => li.classList.remove('active'));
  
    // Add active class to the clicked menu item
    const activeMenuItem = document.querySelector(`.faq-menu li[onclick="filterFAQ('${category}')"]`);
    activeMenuItem.classList.add('active');
  
    // Get all FAQ sections
    const allSections = document.querySelectorAll('.faq-section');
  
    if (category === 'all') {
      // Show all FAQ items
      allSections.forEach(section => (section.style.display = 'block'));
    } else {
      // Hide all sections
      allSections.forEach(section => (section.style.display = 'none'));
  
      // Show only the selected category
      const selectedSection = document.querySelector(`.faq-section.${category}`);
      if (selectedSection) {
        selectedSection.style.display = 'block';
      }
    }
  }
  
  function toggleAnswer(button) {
    const answer = button.nextElementSibling;
    const isOpen = answer.style.display === 'block';
  
    // Close all other answers
    document.querySelectorAll('.faq-answer').forEach(a => (a.style.display = 'none'));
    document.querySelectorAll('.faq-question .icon').forEach(i => (i.textContent = '+'));
  
    // Open the clicked question
    if (!isOpen) {
      answer.style.display = 'block';
      button.querySelector('.icon').textContent = '-';
    }
  }
