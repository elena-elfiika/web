document.addEventListener("DOMContentLoaded", () => {
  const forms = document.querySelectorAll("form[id*='form']");

  forms.forEach((form) => {
    form.addEventListener("submit", function (event) {
      event.preventDefault(); // Предотвращаем стандартное поведение формы

      const formData = new FormData(this);

      fetch("people.php", {
        method: "POST",
        body: formData,
      }).then((response) => {
        if (response.ok) {
          location.reload();
        }
      });
    });
  });

  const likes = document.querySelectorAll("div.like-button > form");
  likes.forEach((like) =>{
    
    like.addEventListener("submit", function (event) {
    event.preventDefault(); // Предотвращаем стандартное поведение формы

    const formData = new FormData(this);

    fetch("like.php", {
      method: "POST",
      body: formData,
    }).then((response) => {
      if (response.ok) {
        location.reload();
      }
    });
  });

  })


});
