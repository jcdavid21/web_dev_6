function performSearch() {
    const query = document.getElementById('search-input').value.toLowerCase(); // Get the search query
    const faqQuestions = document.querySelectorAll('.About-FAQ h4'); // Select all FAQ questions
    const faqAnswers = document.querySelectorAll('.About-FAQ p'); // Select all FAQ answers
    const faqHeader = document.getElementById('faq-header'); // Select the FAQ header
    const introParagraph = document.getElementById('faq-intro'); // Select the intro paragraph
    let foundMatch = false; // Flag to track if any match is found

    // Hide the header and intro paragraph if there's a search query
    if (query) {
        faqHeader.style.display = 'none';
        introParagraph.style.display = 'none';
    } else {
        faqHeader.style.display = 'block'; // Show header if no search query
        introParagraph.style.display = 'block'; // Show intro paragraph if no search query
    }

    // Loop through FAQ questions
    faqQuestions.forEach((question, index) => {
        const title = question.textContent.toLowerCase(); // Get the question text

        // Check if the question matches the search query
        if (title.includes(query)) {
            question.style.display = 'block'; // Show matching question
            faqAnswers[index].style.display = 'block'; // Show corresponding answer
            foundMatch = true; // Set flag to true if a match is found
        } else {
            question.style.display = 'none'; // Hide non-matching question
            faqAnswers[index].style.display = 'none'; // Hide corresponding answer
        }
    });

    // If no query is provided, show all questions and answers
    if (!query) {
        faqQuestions.forEach((question, index) => {
            question.style.display = 'block'; // Show all questions
            faqAnswers[index].style.display = 'block'; // Show corresponding answers
        });
    }
}
