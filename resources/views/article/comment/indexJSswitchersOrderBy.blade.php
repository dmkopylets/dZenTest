<script type="text/javascript">

    function switchedChecOrderByUserName() {
        var unSelectElement = document.getElementById("switchChecOrderByEmail");
        unSelectElement.checked = false;
    }

    function switchedChecOrderByEmail() {
        var unSelectElement = document.getElementById("switchChecOrderByUserName");
        unSelectElement.checked = false;
    }

    function switchedChecOrderByCreatedAt() {
        const orderingSets = <?php echo json_encode($orderingSets); ?>;
        alert(orderingSets.createdAt);
    }
</script>
