document.addEventListener("DOMContentLoaded", () => {
  const forms = document.querySelectorAll("form");

  forms.forEach((form) => {
    form.addEventListener("submit", function (event) {
      event.preventDefault(); // Предотвращаем стандартное поведение формы

      const formData = new FormData(this);

      fetch("", {
        method: "POST",
        body: formData,
      }).then((response) => {
        if (response.ok) {
          location.reload();
        }
      });
    });
  });
});
