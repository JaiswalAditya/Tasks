// var ToggleToast = Swal.mixin({
//     toast: true,
//     position: 'top-end',
//     showConfirmButton: true,
//     timer: 3000,
//     timerProgressBar: true,
//     didOpen: (toast) => {
//       toast.addEventListener('mouseenter', Swal.stopTimer);
//       toast.addEventListener('mouseleave', Swal.resumeTimer);
//     }
//   });

  var toggle = {

      // announcement
      toggleCertificationStatus: function (id) {
          // console.log(id);
          var value = $('#isActiveCheckbox_' + id).prop('checked') ? 1 : 0;
          var settings = {
              url: '/certifications/toggle-active-status?model=AC&type_id=' + id + '&type=A',
              method: 'GET',
              timeout: 0
          };
          $.ajax(settings).done(function (response) {
              // ToggleToast.fire({
              //
              //     icon: 'success',
              //     title: 'Updated successfully'
              // });
              swal({
                  position: "top-end",
                  type: "success",
                  title: "status updated",
                  showConfirmButton: true,
              })
              // window.location.reload();
          });
      }
  };
