async function fetchPatho(event, name){
    const element = event.target.id;

    const result = await fetch("../../Database/FetchPatho.php", {
        method: "POST",
        body: JSON.stringify({name}),
    });

    element.querySelector('p').innerHTML = result;
}