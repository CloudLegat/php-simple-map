<!DOCTYPE html>
<html lang="en">

<head>
    <!-- SEO -->
    <meta name="description" content="map seo description">
    <meta name="keywords" content="map, seo, keywords">
    <title>Simple Map!</title>
    <!-- Так как по ТЗ нужно отлавливать процесс ввода в поле input по мере ввода пользователем, то есть события в DOM, без JS не обойтись -->
    <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo GOOGLE_MAPS_API_KEY; ?>&libraries=places&callback=initAutocomplete" async defer></script>
    <script>
        function initAutocomplete() {
            var input = document.getElementById("addressInput");
            var autocomplete = new google.maps.places.Autocomplete(input);
            autocomplete.setTypes(["geocode"]);
            autocomplete.addListener("place_changed", function() {
                var place = autocomplete.getPlace();
                var selectedAddress = place.formatted_address;
                document.forms[0].submit();
            });
        }
    </script>
</head>

<body>
    <h1>Simple Map!</h1>

    <!-- Форма ввода -->
    <form method="get" action="">
        <input type="text" width="60" name="address" id="addressInput" placeholder="Start typing...">
        <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrfToken, ENT_QUOTES, 'UTF-8') ?>">
        <input type="submit" value="search">
    </form>

    <!-- Карта -->
    <br>
    <?php echo $map; ?>
    <br>

    <!-- История запросов -->
    <h2>Search history</h2>
    <ul>
        <?php foreach ($history as $row) : ?>
            <li><?php echo '[' . $row["request_time"] . ']: ' . $row['address']; ?></li>
        <?php endforeach; ?>
    </ul>
</body>

</html>