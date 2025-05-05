function validate(event) {
    const email = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    const formData = new FormData(event.target);
    let errors = [];

    document.querySelectorAll('.input-error').forEach((node) => node.innerHTML = '');

    if (formData.get('message') === '') errors.push({ 'message': 'Kötelező üzenetet küldeni!' });
    if (formData.get('message').length > 65000) errors.push({ 'message': 'Az üzenet túl hosszú!' });

    if (formData.has('sender_name')) {
        if (formData.get('sender_email') === '') errors.push({ 'sender_email': 'Kötelező a küldő e-mail címet megadni!' });
        if (formData.get('sender_email').length > 100) errors.push({ 'sender_email': 'A küldő e-mail címe túl hosszú!' });
        if (!email.test(formData.get('sender_email'))) errors.push({ 'sender_email': 'A küldő e-mail címe nem megfelelő formátumú!' });

        if (formData.get('sender_name') === '') errors.push({ 'sender_name': 'Kötelező a küldő nevét megadni!' });
        if (formData.get('sender_name').length > 100) errors.push({ 'sender_name': 'A küldő neve túl hosszú!' });
    }

    if (errors.length) {
        errors.forEach((error) => {
            document.querySelector(`.input-error#error_${Object.keys(error)[0]}`).innerHTML += Object.values(error)[0];
        });
        event.preventDefault();
        return false;
    }

    return true;
}