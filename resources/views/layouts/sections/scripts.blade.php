<!-- BEGIN: Vendor JS-->
<script src="{{ asset(mix('assets/vendor/libs/jquery/jquery.js')) }}"></script>
<script src="{{ asset(mix('assets/vendor/libs/popper/popper.js')) }}"></script>
<script src="{{ asset(mix('assets/vendor/js/bootstrap.js')) }}"></script>
<script src="{{ asset(mix('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')) }}"></script>
<script src="{{ asset(mix('assets/vendor/js/menu.js')) }}"></script>
@yield('vendor-script')
<!-- END: Page Vendor JS-->
<!-- BEGIN: Theme JS-->
<script src="{{ asset(mix('assets/js/main.js')) }}"></script>

<!-- END: Theme JS-->
<!-- Pricing Modal JS-->
@stack('pricing-script')
<!-- END: Pricing Modal JS-->
<!-- BEGIN: Page JS-->
@yield('page-script')
<!-- END: Page JS-->

<script>
    window.addEventListener('show-toast', event => {
        const toastPlacementExample = document.querySelector('.toast-placement-ex'),
        toastBodyMessage = document.querySelector(".toast-body")
        toastPlacementBtn = document.querySelector('#showToastPlacement');
        let selectedType, toastPlacement;

        if (event.detail[0].type == "success") {
            selectedType = "bg-primary";
        } else if (event.detail[0].type == "error") {
            selectedType = "bg-danger";
        }
        toastBodyMessage.innerHTML = event.detail[0].message;
        toastPlacementExample.classList.add(selectedType);
        DOMTokenList.prototype.add.apply(toastPlacementExample.classList, toastBodyMessage);
        toastPlacement = new bootstrap.Toast(toastPlacementExample);
        toastPlacement.show();
        document.querySelector(".btn-close").click();
    });

    window.addEventListener('close-modal', event => {
        $('#close-modal').click();
    });

    window.addEventListener('export-data', event => {
        $('#infoImgModal').modal('show');
    });

    $('#infoImgModal').on('hidden.bs.modal', function () {
        const canvas = document.getElementById('member-info-img');
        const ctx = canvas.getContext('2d');
        ctx.clearRect(0, 0, canvas.width, canvas.height);
    })
</script>
