const getError = () => {
    fetch('error_handle.php')
        .then(r => r.json())
        .then(data => console.log(data));
}