function toggleSidebar() {
    const sidebar = document.querySelector('.sidebar');
    const allSubmenus = document.querySelectorAll('.submenu');
    const allMenuItems = document.querySelectorAll('.menu-item');

    // Retrair ou expandir a sidebar
    sidebar.classList.toggle('retracted');
    sidebar.classList.toggle('open');

    // Fechar todos os submenus quando a sidebar estiver retraída
    if (sidebar.classList.contains('retracted')) {
        allMenuItems.forEach(item => item.classList.remove('open'));
        allSubmenus.forEach(submenu => submenu.classList.remove('open'));
    }

}

function toggleSubmenu(menuItem) {
    const sidebar = document.querySelector('.sidebar');

    // Impedir abertura de submenus quando a sidebar estiver retraída
    if (sidebar.classList.contains('retracted')) {
        return;
    }

    const allMenuItems = document.querySelectorAll('.menu-item');
    const allSubmenus = document.querySelectorAll('.submenu');

    // Encontrar o submenu associado ao item clicado
    const submenu = menuItem.nextElementSibling;

    // Fechar todos os submenus, exceto o clicado
    allMenuItems.forEach(item => {
        if (item !== menuItem) {
            item.classList.remove('open');
        }
    });
    allSubmenus.forEach(sub => {
        if (sub !== submenu) {
            sub.classList.remove('open');
        }
    });

    // Alternar o estado do submenu clicado
    if (submenu && submenu.classList.contains('submenu')) {
        submenu.classList.toggle('open');
        menuItem.classList.toggle('open');
    }
}

let aside = document.querySelector('.sidebar');
let menu = aside.querySelector('ul');

// Abre o menu
menu.addEventListener('mouseover', function () {
    if (aside.classList.contains('retracted')) {
        aside.classList.remove('retracted');
    }
});

// Fecha o menu
menu.addEventListener('mouseleave', function () {
    if (!aside.classList.contains('retracted') && aside.classList.contains('open')) {
        aside.classList.add('retracted');
        const allSubmenus = document.querySelectorAll('.submenu');
        allSubmenus.forEach(submenu => submenu.classList.remove('open'));
    }
});
