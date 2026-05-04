window.onload = function() {
/*
    // Inicializar Swiper
    const progressCircle = document.querySelector(".autoplay-progress svg");
    const progressContent = document.querySelector(".autoplay-progress span");
    const swiper = new Swiper('.swiper', {
        slidesPerView: 3,
        spaceBetween: 30,
        loop: true,
        autoplay: {
            delay: 3000,
            disableOnInteraction: false
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        on: {
            autoplayTimeLeft(s, time, progress) {
                progressCircle.style.setProperty("--progress", 1 - progress);
                progressContent.textContent = `${Math.ceil(time / 1000)}s`;
            }
        }
    });
*/
    let cicloSelect = document.getElementById('ciclo');

    let categoriaSelect = document.getElementById('categoria');
    let camposAlumnos = document.getElementsByClassName('alumnos');
    let camposApellidos = document.getElementsByClassName('apellidos');
    let campoGrupo = document.getElementsByClassName('grupo')[0];

    let fpBasicaCategorias = [3, 4];
    let fpGradoMedioCategorias = [1, 2, 3, 4];
    let fpGradoSuperiorCategorias = [2, 3, 4];

    cicloSelect.addEventListener('change', function() {
        let gradoId = cicloSelect.options[cicloSelect.selectedIndex].className;
        if (gradoId != '') {
            categoriaSelect.disabled = false;
            categoriaSelect.options[0].selected = true;
            campoGrupo.classList.add('oculto');
            for (let i = 0; i < camposAlumnos.length; i++) {
              camposAlumnos[i].classList.add('oculto');
              camposAlumnos[i].value = '';
              camposApellidos[i].classList.add('oculto');
              camposApellidos[i].value = '';
            }
            for (let i = 0; i < categoriaSelect.options.length; i++) {
              let categoria = categoriaSelect.options[i];
              switch (gradoId) {
                case '1':
                  if(fpBasicaCategorias.includes(parseInt(categoria.value))) {
                    categoria.style.display = 'block';
                  } else {
                    categoria.style.display = 'none';
                  }
                  break;
                case '2':
                    categoria.style.display = 'block';
                  break;
                case '3':
                  if(fpGradoSuperiorCategorias.includes(parseInt(categoria.value))) {
                    categoria.style.display = 'block';
                  } else {
                    categoria.style.display = 'none';
                  }
                  break;
              }
            }
        } else {
            categoriaSelect.disabled = true;
            categoriaSelect.options[0].selected = true;
            for (let i = 0; i < camposAlumnos.length; i++) {
              camposAlumnos[i].classList.add('oculto');
              camposAlumnos[i].value = '';
              camposApellidos[i].classList.add('oculto');
              camposApellidos[i].value = '';
            }
            campoGrupo.classList.add('oculto');
        }
    });
    categoriaSelect.addEventListener('change', function() {
      campoGrupo.classList.add('oculto');
      switch (categoriaSelect.value) {
        case '1':
        case '2':
          limite = 3;
          break;
        case '3':
          limite = 10;
          break;
        case '4':
          limite = 7;
          break;
      }
      for (let i = 0; i < camposAlumnos.length; i++) {
        camposAlumnos[i].classList.add('oculto');
        camposApellidos[i].classList.add('oculto');
      }
      for (let i = 0; i < limite; i++) {
      camposAlumnos[i].classList.remove('oculto');
      camposApellidos[i].classList.remove('oculto');
      }
      campoGrupo.classList.remove('oculto');
    });
  }
