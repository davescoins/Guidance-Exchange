const currentURL = new URL(location.href);

const signupStatus = currentURL.searchParams.get('signup');
console.log(currentURL, signupStatus);

if(signupStatus == 'success'){

    alert("Thank you for signing up!");
}
