function populateTableFromJSON() {
    $.get("http://localhost/Kerim123/file4.json", function(data) {
        let output = "";
        data.forEach(function(product) {
            output += `
                <tr>
                    <td>${product.id}</td>
                    <td>${product.comment}</td>
                    <td>${product.name}</td>
                    <td>${product.rating}</td>
                </tr>
            `;
        });
        $("#data-output4").html(output); // Using jQuery to set HTML content
    })
    .fail(function(error) {
        console.error("Error fetching JSON:", error);
    });
}

// Call the function to populate the table
populateTableFromJSON();