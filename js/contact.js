/* Contact Form */
"use strict";
(function () {
  var contactForm = {
    initialized: false,
    initialize: function () {
      if (this.initialized) return;
      this.initialized = true;
      this.build();
      this.events();
    },
    build: function () {
      this.validations();
    },
    events: function () {},
    validations: function () {
      var contactform = $("#contact-form"),
        url = contactform.attr("action");

      contactform.validate({
        submitHandler: function (form) {
          var submitButton = $(this.submitButton);
          submitButton.button("loading");

          $.ajax({
            type: "POST",
            url: url,
            data: {
              name: $("#contact-form #name").val(),
              email: $("#contact-form #email").val(),
              message: $("#contact-form #message").val(),
              subject: "New Message From Contact Form" // You may want to change this
            },
            dataType: "json",
            success: function (data) {
              console.log("Server response:", data); // Debug

              if (data.response === "success") {
                $("#contact-alert-success").removeClass("hidden");
                $("#contact-alert-error").addClass("hidden");

                $("#contact-form .form-control")
                  .val("")
                  .blur()
                  .parent()
                  .removeClass("has-success has-error")
                  .find("label.error")
                  .remove();

                $("html, body").animate({
                  scrollTop: $("#contact-alert-success").offset().top - 80
                }, 300);
              } else {
                $("#contact-alert-error").removeClass("hidden");
                $("#contact-alert-success").addClass("hidden");

                $("html, body").animate({
                  scrollTop: $("#contact-alert-error").offset().top - 80
                }, 300);
              }
            },
            error: function (xhr, status, error) {
              console.error("AJAX error:", status, error);
              $("#contact-alert-error").removeClass("hidden");
              $("#contact-alert-success").addClass("hidden");
              $("html, body").animate({
                scrollTop: $("#contact-alert-error").offset().top - 80
              }, 300);
            },
            complete: function () {
              submitButton.button("reset");
            }
          });
        },
        rules: {
          name: { required: true },
          email: { required: true, email: true },
          message: { required: true }
        },
        highlight: function (element) {
          $(element).parent().removeClass("has-success").addClass("has-error");
        },
        success: function (element) {
          $(element)
            .parent()
            .removeClass("has-error")
            .addClass("has-success")
            .find("label.error")
            .remove();
        }
      });
    }
  };
  contactForm.initialize();
})();