(function formBtns(){
  const btns = document.querySelectorAll('button[type=button][aria-controls]');

  btns.forEach((btn)=>{
    btn.onclick = ()=>{
      console.log(btn)
      const i = btn.querySelector('i');
      if(i.classList.contains('bi-lock-fill')){
        i.classList.remove('bi-lock-fill');
        i.classList.add('bi-unlock-fill');
      }
      else {
        i.classList.add('bi-lock-fill');
        i.classList.remove('bi-unlock-fill');
      }

      const input =
        document.querySelector(`input[name=${btn.getAttribute('aria-controls')}]`);

      input.toggleAttribute('disabled');
    }
  });
})();
