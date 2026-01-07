// Toggle Sidebar
function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    sidebar.classList.toggle('open');
  }
  
  // Toggle Submenu
  // function toggleSubmenu(element) {
  //   const parent = element.parentElement;
  //   const submenu = parent.querySelector('.submenu');
    
  //   if (submenu.style.display === 'block') {
  //     submenu.style.display = 'none';
  //     parent.classList.remove('open');
  //   } else {
  //     // Close other open submenus
  //     document.querySelectorAll('.submenu-parent').forEach(item => {
  //       item.classList.remove('open');
  //       item.querySelector('.submenu').style.display = 'none';
  //     });
  
  //     submenu.style.display = 'block';
  //     parent.classList.add('open');
  //   }
  // }

  // Code by JK Start 

  const categoryLink = document.getElementById('categoryLink');
  const megamenu = document.getElementById('megamenu');
  
  categoryLink.addEventListener('mouseover', () => {
    megamenu.style.display = 'block';
  });
  
  categoryLink.addEventListener('mouseout', () => {
    setTimeout(() => {
      if (!megamenu.matches(':hover')) {
        megamenu.style.display = 'none';
      }
    }, 100); // slight delay to allow hover to move into megamenu
  });
  
  megamenu.addEventListener('mouseover', () => {
    megamenu.style.display = 'block';
  });
  
  megamenu.addEventListener('mouseout', () => {
    megamenu.style.display = 'none';
  });

   // Code by JK End

  // Added by Jk ... Start 
  document.querySelectorAll('.inner-sub-menu-list').forEach(item => {
    item.addEventListener('mouseenter', function () {
        const submenu = this.querySelector('.inner-sub-menu');
        if (submenu) {
            // Always reset first
            submenu.classList.remove('open-left');

            // Temporarily make visible for measuring
            submenu.style.visibility = 'hidden';
            submenu.style.opacity = '0';
            submenu.style.display = 'block';

            const rect = submenu.getBoundingClientRect();
            const willOverflow = rect.left + rect.width > window.innerWidth;

            // Revert styles
            submenu.style.display = '';
            submenu.style.visibility = '';
            submenu.style.opacity = '';

            if (willOverflow) {
                submenu.classList.add('open-left');
            }
        }
    });
});



    // Added by Jk ... End 