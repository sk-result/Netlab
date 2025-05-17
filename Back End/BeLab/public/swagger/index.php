<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Swagger UI</title>
  <link rel="stylesheet" href="https://unpkg.com/swagger-ui-dist/swagger-ui.css">
</head>

<body>
  <div id="swagger-ui"></div>
  <script src="https://unpkg.com/swagger-ui-dist/swagger-ui-bundle.js"></script>

  <script>
    window.onload = function() {
      SwaggerUIBundle({
        urls: [{
            url: "swagger/user-api.json",
            name: "User API"
          },
          {
            url: "swagger/crud-category.json",
            name: "Category API"
          },
          {
            url: "swagger/crud-category-matkul.json",
            name: "Matkul Category API"
          },
          {
            url: "swagger/crud-equipment.json",
            name: "Equipment API"
          },
          {
            url: "swagger/crud-materi-matkul.json",
            name: "Materi Matkul API"
          },
          {
            url: "swagger/crud-pendaftaran.json",
            name: "Pendaftaran API"
          },
          {
            url: "swagger/crud-about.json",
            name: "About API"
          }
        ],
        dom_id: '#swagger-ui',
        deepLinking: true,
        presets: [
          SwaggerUIBundle.presets.apis,
          SwaggerUIStandalonePreset
        ],
        layout: "StandaloneLayout"
      });
    };
  </script>

  <script src="https://unpkg.com/swagger-ui-dist/swagger-ui-standalone-preset.js"></script>

</body>

</html>