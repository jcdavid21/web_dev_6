function ai_generateResponse() {
    const textInput = document.getElementById("text");
    const responseContainer = document.getElementById("response");
    const responseWrapper = document.getElementById("response-container");
    const inputText = textInput.value.trim() || textInput.placeholder.replace('Ask me anything about ', '');

    // Show loading state
    responseWrapper.classList.remove("hidden");
    responseContainer.innerHTML = '<p class="text-gray-500 italic">Generating response...</p>';

    fetch("../components/ai_response.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({
            text: `Generate a fun and engaging trivia or interesting fact about ${inputText}`,
        })
    })
        .then(response => response.ok ? response.json() : Promise.reject('Failed to fetch'))
        .then(data => {
            responseContainer.innerHTML = data.error
                ? `<p class="text-red-500">Error: ${data.error}</p>`
                : data.text || "No response";
        })
        .catch(error => {
            console.error(error);
            responseContainer.innerHTML = `<p class="text-red-500">An error occurred: ${error}</p>`;
        });

    textInput.value = ''; // Clear input
}
