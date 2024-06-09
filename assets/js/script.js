$(document).ready(function() { 

    function refreshResources() {
        $.ajax({
            url: 'ajax/refresh_rsc.php',
            method: 'GET',  // Using GET instead of POST
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    console.log(response.message);
                    fetchLatestResources(); // Fetch the latest resource values
                } else {
                    console.error(response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('refresh_rsc error:', error);
                console.error('responseText:', xhr.responseText);
            }
        });
    }
    function formatNumber(num) {
        return num.toLocaleString('de-DE'); // Utilisation de 'de-DE' pour le format allemand (10.000)
    }

    function fetchLatestResources() {
        $.ajax({
            url: 'ajax/get_rsc.php', // Endpoint to fetch the latest resource values
            method: 'GET',  // Using GET instead of POST
            dataType: 'json',
            success: function(data) {
                $('.rsc').text(data.rsc);
                $('.rsc2').text(data.rsc2);
                $('.rsc3').text(data.rsc3);
                $('.rsc4').text(data.rsc4);
            }
        });
    }

    // Update resources every second
    setInterval(refreshResources, 1000);
}); 
    document.addEventListener("DOMContentLoaded", function() {
    const paragraphs = document.querySelectorAll(".stat p");
    const speed = 10; // Speed in milliseconds
    let paraIndex = 0;
    let charIndex = 0;
    
    function typeWriter() {
        if (paraIndex < paragraphs.length) {
            const currentPara = paragraphs[paraIndex];
            const text = currentPara.getAttribute('data-full-text') || currentPara.textContent;

            if (!currentPara.getAttribute('data-full-text')) {
                currentPara.setAttribute('data-full-text', text);
                currentPara.textContent = ""; // Clear text content initially
                currentPara.classList.remove('hidden'); // Make paragraph visible
            }

            if (charIndex < text.length) {
                currentPara.textContent += text.charAt(charIndex);
                charIndex++;
                setTimeout(typeWriter, speed);
            } else {
                charIndex = 0;
                paraIndex++;
                setTimeout(typeWriter, speed); // Move to the next paragraph after finishing the current one
            }
        }
    }

    typeWriter();
});


$(document).ready(function() {
    // Lorsque vous cliquez sur un élément .list-element
    $('.list-element').click(function(event) { 
        // Cacher tous les éléments .filter
        $('.filter').hide();
        // Afficher le prochain élément .filter après l'élément .list-element cliqué
        $(this).next('.filter').show(); 
        // Empêcher la propagation de l'événement de clic pour éviter que le document ne gère cet événement
        event.stopPropagation();
    });

    // Lorsque vous cliquez sur l'élément .closeForm
    $('.closeForm').click(function(event) {
        // Cacher tous les éléments .filter
        $('.filter').hide();
        // Empêcher la propagation de l'événement de clic pour éviter que le document ne gère cet événement
        event.stopPropagation();
    });

    // Lorsque vous cliquez sur le document
    $(document).click(function(event) {
        // Vérifier si l'élément cliqué est à l'intérieur d'une div.dataBuilding
        if (!$(event.target).closest('.dataBuilding').length) {
            // Si l'élément cliqué n'est pas à l'intérieur d'une div.dataBuilding, cacher tous les éléments .filter
            $('.filter').hide();
        }
    });
}); 

