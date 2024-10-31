function performSearch() {
    const query = document.getElementById('search-input').value.toLowerCase(); // Get the search query
    const policySections = document.querySelectorAll('.Policies h4'); // Select all headings in the policies section
    const paragraphs = document.querySelectorAll('.Policies p'); // Select all paragraphs in the policies section
    const privacyHeader = document.getElementById('privacy-header'); // Select the privacy header
    const introParagraph = document.getElementById('intro-paragraph'); // Select the intro paragraph
    let foundMatch = false; // Flag to track if any match is found

    // Hide the header and intro paragraph if there's a search query
    if (query) {
        privacyHeader.style.display = 'none';
        introParagraph.style.display = 'none';
    } else {
        privacyHeader.style.display = 'block'; // Show header if no search query
        introParagraph.style.display = 'block'; // Show intro paragraph if no search query
    }

    // Loop through headings
    policySections.forEach(section => {
        const title = section.textContent.toLowerCase(); // Get the section title

        if (title.includes(query)) {
            section.style.display = 'block'; // Show matching headings
            section.nextElementSibling.style.display = 'block'; // Show the paragraph after the heading
            foundMatch = true; // Set flag to true if a match is found
        } else {
            section.style.display = 'none'; // Hide non-matching headings
            section.nextElementSibling.style.display = 'none'; // Hide the paragraph after the heading
        }
    });

    // Loop through paragraphs if you want to include them in the search
    paragraphs.forEach(paragraph => {
        const text = paragraph.textContent.toLowerCase(); // Get the paragraph text

        if (text.includes(query)) {
            paragraph.style.display = 'block'; // Show matching paragraphs
            foundMatch = true; // Set flag to true if a match is found
        } else {
            paragraph.style.display = 'none'; // Hide non-matching paragraphs
        }
    });

    // If no query is provided, show all sections
    if (!query) {
        policySections.forEach(section => {
            section.style.display = 'block'; // Show all headings
            section.nextElementSibling.style.display = 'block'; // Show the corresponding paragraphs
        });
        paragraphs.forEach(paragraph => {
            paragraph.style.display = 'block'; // Show all paragraphs
        });
    }
}
