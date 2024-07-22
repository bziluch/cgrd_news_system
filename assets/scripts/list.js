
function loadEditPage(event) {
    const id = event.currentTarget.getAttribute('data-id')
    const request = new XMLHttpRequest();
    request.open('GET', '/edit-article/'+id)
    request.setRequestHeader('X-xhr-request', 'XMLHttpRequest')
    request.send()
    request.onreadystatechange = () => {
        if (request.readyState === XMLHttpRequest.DONE) {
            if (request.status === 200) {
                document.getElementById('form-section').innerHTML = request.responseText
                window.history.pushState({"html":request.responseText,"pageTitle":document.title},"", request.responseURL)
                setUpCloseListener()
            } else {
                console.error('Request ended with status code ' + request.status)
            }
        }
    }
}

function closeEditPage(event) {
    const request = new XMLHttpRequest();
    request.open('GET', '/')
    request.setRequestHeader('X-xhr-request', 'XMLHttpRequest')
    request.send()
    request.onreadystatechange = () => {
        if (request.readyState === XMLHttpRequest.DONE) {
            if (request.status === 200) {
                document.getElementById('form-section').innerHTML = request.responseText
                window.history.pushState({"html":request.responseText,"pageTitle":document.title},"", request.responseURL)
            } else {
                console.error('Request ended with status code ' + request.status)
            }
        }
    }
}

function setUpListeners() {
    const buttons = document.getElementsByClassName("edit-btn")
    Array.prototype.forEach.call(buttons, function(el) {
        el.addEventListener("click", loadEditPage, false)
    })
}

function setUpCloseListener() {
    const buttons = document.getElementsByClassName("close-edit-btn")
    Array.prototype.forEach.call(buttons, function(el) {
        el.addEventListener("click", closeEditPage, false)
    })
}

(function() {
    setUpListeners()
    setUpCloseListener()
})()