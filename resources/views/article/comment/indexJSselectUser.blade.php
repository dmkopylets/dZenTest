<script type="text/javascript">
    const usersList = <?php echo json_encode($usersList); ?>;

    function SelectUser() {
        var selectElement = document.getElementById("userDialer");
        let selectedIndex = parseInt(selectElement.value);
        const user = usersList.find(user => user.id === selectedIndex);
        document.getElementById("user_id").value = user.id;
        document.getElementById("User_Name").value = user.name;
        document.getElementById("email").value = user.email;
    }
</script>
