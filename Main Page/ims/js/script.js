// Fungsi untuk menampilkan pesan alert
function showAlert(message, type) {
    var alertDiv = document.createElement('div');
    alertDiv.classList.add('alert');
    alertDiv.classList.add(type === 'success' ? 'alert-success' : 'alert-danger');
    alertDiv.innerHTML = message;
    document.body.insertBefore(alertDiv, document.body.firstChild);
  
    setTimeout(function() {
      document.body.removeChild(alertDiv);
    }, 3000);
  }
  
  // Fungsi untuk validasi form input
  function validateForm(formId) {
    var form = document.getElementById(formId);
    var isValid = true;
  
    // Validasi setiap input field
    for (var i = 0; i < form.elements.length; i++) {
      var field = form.elements[i];
      if (field.required && field.value.trim() === '') {
        showAlert('Silakan isi semua kolom yang wajib diisi!', 'danger');
        isValid = false;
        break;
      }
    }
  
    return isValid;
  }
  
  // Fungsi untuk menangani submit form (dapat dimodifikasi sesuai kebutuhan)
  function handleFormSubmit(formId, actionUrl) {
    if (validateForm(formId)) {
      var form = document.getElementById(formId);
      var formData = new FormData(form);
  
      fetch(actionUrl, {
        method: 'POST',
        body: formData
      })
        .then(response => response.json())
        .then(data => {
          if (data.status === 'success') {
            showAlert(data.message, 'success');
            // Reset form jika perlu
            form.reset();
          } else {
            showAlert(data.message, 'danger');
          }
        })
        .catch(error => {
          console.error('Error:', error);
          showAlert('Terjadi kesalahan. Silakan coba lagi.', 'danger');
        });
    }
  }
  
  // Contoh penggunaan fungsi-fungsi tersebut
  
  // Menampilkan pesan alert success
  showAlert('Selamat datang di Inventory Management System!', 'success');
  
  // Menangani submit form tambah produk
  document.getElementById('add-product-form').addEventListener('submit', function(event) {
    event.preventDefault();
    handleFormSubmit('add-product-form', 'add_product.php');
  });
  
  // Menangani submit form edit produk
  document.getElementById('edit-product-form').addEventListener('submit', function(event) {
    event.preventDefault();
    handleFormSubmit('edit-product-form', 'update_product.php');
  });
  
  // ... (dapat ditambahkan fungsionalitas JavaScript lainnya untuk halaman lain)
  