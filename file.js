function populateTableFromJSON() {
    $.get("http://localhost/Kerim123/file.json", function(data) {
        let output = "";
        data.forEach(function(product) {
            output += `
                <tr>
                    <td>${product.id}</td>
                    <td>${product.name}</td>
                    <td>${product.surname}</td>
                    <td>${product.price}</td>
                </tr>
            `;
        });
        $("#data-output").html(output); // Using jQuery to set HTML content
    })
    .fail(function(error) {
        console.error("Error fetching JSON:", error);
    });
}

// Call the function to populate the table
populateTableFromJSON();