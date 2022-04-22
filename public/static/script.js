const makeDebug = document.getElementById("debugButton")
const makeWarning = document.getElementById("warningButton")
const makeError = document.getElementById("errorButton")


function updatePage() {
    document.location.reload();
}

function makeLog(page) {
    fetch(page)
        .then(updatePage)
        .catch(() => { alert("Something went wrong...") })
}

makeDebug.addEventListener('click', () => { makeLog('debug.php') })
makeWarning.addEventListener('click', () => { makeLog('warning.php') })
makeError.addEventListener('click', () => { makeLog('error.php') })

