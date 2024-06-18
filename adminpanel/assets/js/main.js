document.addEventListener("DOMContentLoaded", function() {
  // Menu Toggle
  let toggle = document.querySelector(".toggle");
  let navigation = document.querySelector(".navigation");
  let main = document.querySelector(".main");

  toggle.onclick = function () {
    navigation.classList.toggle("active");
    main.classList.toggle("active");
  };

  // Function to set active link based on current URL
  function setActiveLink() {
    let list = document.querySelectorAll(".navigation ul li");
    let currentPage = window.location.pathname.split("/").pop();

    list.forEach((item) => {
      let link = item.querySelector("a").getAttribute("href");

      // Check if the link ends with currentPage (adjust for your URLs)
      if (link.endsWith(currentPage)) {
        item.classList.add("active");
      } else {
        item.classList.remove("active");
      }
    });
  }

  // Initial call to set active link when page loads
  setActiveLink();

  // Add click event listener to each item
  let menuItems = document.querySelectorAll(".navigation ul li");
  menuItems.forEach((item) => {
    item.addEventListener("click", function(event) {
      event.preventDefault(); // Prevent default link behavior
      let link = this.querySelector("a").getAttribute("href");
      window.location.href = link; // Navigate to the clicked link

      // Set active link after navigation
      setActiveLink();

      // Toggle navigation and main active classes if needed
      navigation.classList.toggle("active");
      main.classList.toggle("active");
    });
  });

  // Add hovered class to selected list item
  function handleMouseOver() {
    menuItems.forEach((item) => {
      item.classList.remove("hovered");
    });
    this.classList.add("hovered");
  }

  menuItems.forEach((item) => item.addEventListener("mouseover", handleMouseOver));

  // Listen for hash changes (for single-page applications)
  window.addEventListener("hashchange", setActiveLink);
});
