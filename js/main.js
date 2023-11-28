const navItems = document.querySelector(".nav-items");
const closeNavBtn = document.querySelector("#close__nav-btn");
const openNavBtn = document.querySelector("#open__nav-btn");
// open nav drop down menu
const openNav = () => {
  navItems.style.display = "flex";
  closeNavBtn.style.display = "inline-block";
  openNavBtn.style.display = "none";
};
// close nav drop down menu
const closeNav = () => {
  navItems.style.display = "none";
  closeNavBtn.style.display = "none";
  openNavBtn.style.display = "inline-block";
};
openNavBtn.addEventListener("click", openNav);
closeNavBtn.addEventListener("click", closeNav);

const sidebar = document.querySelector("aside");
const showSidebarBtn = document.querySelector("#show-sidebar-btn");
const hideSidebarBtn = document.querySelector("#hide-sidebar-btn");

const showSidebar = () => {
  showSidebarBtn.style.display = "none";
  hideSidebarBtn.style.display = "inline-block";
  sidebar.style.display = "block";
  sidebar.style.left = "0";
};
const hideSidebar = () => {
  hideSidebarBtn.style.display = "none";
  showSidebarBtn.style.display = "inline-block";
  sidebar.style.left = "-100%";
};

showSidebarBtn.addEventListener("click", showSidebar);
hideSidebarBtn.addEventListener("click", hideSidebar);
