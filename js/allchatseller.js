// Get the chat container element
const chatContainer = document.getElementById('chat-container');
// Function to scroll the chat container to the bottom
function scrollToBottom() {
    chatContainer.scrollTop = chatContainer.scrollHeight;
}

window.onload = () => {
    // Function to be executed every 5 seconds
    function sendDataToServer() {
        // Create new XMLHttpRequest object
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "./php/allchatseller.php", true);
        xhr.responseType = 'document'; // Set response type to 'document' to handle HTML response

        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    let data = xhr.response;
                    if (data) {
                        // Create a new <div> element
                        let div = document.createElement('div');
                        
                        // Append the content of the response document to the <div> element
                        div.appendChild(data.documentElement);
                        
                        // Remove all existing child elements from chatContainer
                        while (chatContainer.firstChild) {
                            chatContainer.removeChild(chatContainer.firstChild);
                        }
                        
                        // Append the new <div> element to 'chat-container'
                        chatContainer.appendChild(div);

                        // Scroll to the bottom after adding new content
                        // scrollToBottom();
                    }
                }
            }
        };

        let formData = new FormData(form); 
        xhr.send(formData);
    }

    // Call the function immediately (on page load)
    sendDataToServer();

    // Call the function every 5 seconds
    setInterval(sendDataToServer, 5000);
};
