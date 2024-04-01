function populateTableFromJSON() {
    $.get("http://localhost/Kerim123/file2.json", function(data) {
        let output = "";
        data.forEach(function(product) {
            output += `
                <tr>
                    <td>${product.id}</td>
                    <td>${product.name}</td>
                    <td>${product.comment}</td>
                </tr>
            `;
        });
        $("#data-output2").html(output); // Using jQuery to set HTML content
    })
    .fail(function(error) {
        console.error("Error fetching JSON:", error);
    });
}

// Call the function to populate the table
populateTableFromJSON();