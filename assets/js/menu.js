function getNavItems(){
  return document.querySelectorAll('nav>.nav-item');
}

function getMiniMenuBody(){
  const closeBrnContainer = document.createElement('div');
  closeBrnContainer.classList.add('close-mini-menu-btn-container');

  const closeBtn = document.createElement("button");
  closeBtn.setAttribute('type','button');
  closeBtn.classList.add('i-btn');

  const icon = document.createElement('i');
  icon.classList.add('bi');
  icon.classList.add('bi-x-square-fill');

  closeBtn.append(icon);

  const menu = document.createElement('section');
  menu.classList.add('mini-menu');
  menu.id = 'mini-menu';

  closeBrnContainer.append(closeBtn);
  menu.append(closeBrnContainer);

  closeBtn.onclick = ()=>{menu.remove()};

  return menu;
}

(function initMenu(){
  const btn = document.querySelector('.nav-item-min>button[type=button]');
  btn.onclick = ()=>{
    const menu = getMiniMenuBody();
    const items = getNavItems();
    items.forEach((item)=>menu.append(item.cloneNode(true)));

    document.body.append(menu);
  };
})();
