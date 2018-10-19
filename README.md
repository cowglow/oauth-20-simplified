# OAuth 2.0 Simplified

A fancy presentation of the principles set forth by [@aaronpk](https://twitter.com/aaronpk) book of the same title.

## Instructions
- Create an OAuth App with [GitHub](https://github.com/settings/developers)
![](images/1-oauth-github-application.png)

- Register client application
![](images/2-oauth-github-registration.png)

- Store Client Id and Client Secret on `lib/clientData.php`
![](images/3-oauth-github-clientdata.png)

- Run a local PHP Server from directory `php -S localhost:8888`

## For more information
- [Aaron Parecki](https://github.com/aaronpk/sample-oauth2-client)
- Book: [OAuth 2.0 Simplified](https://oauth2simplified.com/)

# Codebase 
This is writen from what I remembered and what I wrote down on my notes.
Feel free to fork and modifity to your use. Obviously it's just to get you to request your GitHub Repo list.

Just the public ones.
### Point of Entry (oauth-20-simplified.php)
Your starting file is named after the repository. This script created a variable `$loginLink` that's used to assemble your login link; feel free to rename to `index.php` in your local dev environment.
- `client_id` // value stored in `lib/clientData.php`
- `redirect_link` // where you're gonna exchage a short term code for a token
- `scope` // Refer to the [GitHub Documentation](https://developer.github.com/apps/building-oauth-apps/understanding-scopes-for-oauth-apps/)
- `state` // The script will genereate that on load.
- 

```
/* Example of Login Button
/* oauth-20-simplified.php */
<a class="btn" href="<?= $loginLink; ?>">OAuth Login</a>
```
### Callback 
When GitHub authenticates you, you'll get a code to exachange for a token. This is where you both request it and store it to the Session. You will be required to proceed in this example. Feel free to fork it.
- `clientData['clientSecret']` // First time used
- Store the token `$_SESSION['access_token'] = $tokenData->access_token`

### App 
With the `access_token` saved to the session, you can now use it to make request to the GitHub API. Notice that the curl request on this file is to the GitHub API and not GitHub OAuth Autherize like in previous files. 
- Insert `Authorization: Bearer '.$_SESSION['access_token']` to HTTP Headers
- Loops `$repos` and builds an ordered list


