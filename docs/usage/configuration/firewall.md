# Coraza Web Application Firewall

This template comes with a firewall for your web application: [Coraza WAF](https://coraza.io/).

Coraza WAF integrates directly into the Caddy web server. It is also a drop-in
replacement for ModSecurity, which means that your ModSecurity knowledge and
configurations can be used in Coraza WAF as well.


## Built-in configuration

Here are the firewall configurations provided by this template:

- The [OWASP Core Rule Set](https://owasp.org/www-project-modsecurity-core-rule-set/)
  - This provides detection and prevention rules for the majority of known 
  	attack vectors for web applications. This is where most of the firewall's 
		defensive strength comes from.
  - This is downloaded and installed at build time (in the `Dockerfile`).
- OWASP CRS overwrites (`docker/caddy/coreruleset-overwrites/rules/`)
  - Some rules from the CRS use regexes that aren't supported by our 
    container's OS and librairies. These overwrites either change the rules to
		provide slightly slower but more compatible version of the same rules, or 
		simply disable the rules when there are no alternative versions.
- Eckinox-specific overwrites (`docker/caddy/coraza-eckinox-overwrites.conf`).
  - This file overwrites or disables rules that very commonly trigger false 
    positives in the context of the web applications we built at Eckinox.
- Project-specific overwrite file (`docker/caddy/coraza-project-overwrites.conf`)
  - This file provides a space for you to add your own project-specific 
    configuration for Coraza WAF, such as disabling a rule, changing the action 
		that is triggered by a rule, or adding completely new rules.


## Editing the firewall's configuration

With the provided default configurations, it's unlikely you will have to 
adjust the firewall's configurations. 

However, if a scenario arises where 
### Editing a rule

There are many ways to edit a rule, but the most common ones are:

- [Editing the rule's actions](/docs/usage/configuration/firewall.md#editing-a-rule).
- Overwriting the rule 
  - To do that, comment out and re-implement the rule in an overwrite file in `docker/caddy/coreruleset-overwrites/`.
  	- Use the original CRS file as a starting point. Check the [CRS GitHub repository](https://github.com/coreruleset/coreruleset/) 
		  to get the original rule file (make sure to check the same version as 
			your project currently use).
  - If you create a new overwrite file, you'll need to update the Dockerfile 
    for the new file to be copied over.


### Disabling a rule

**🚩 Disabling a rule should be a last resort. Do not do it if you have not 
considered updating your application to prevent suspicious requests and editing 
the rule to prevent false positives.**

To disable a rule completely, you first need to [find the rule's ID](/docs/usage/troubleshooting/firewall.md#finding-the-problem-in-the-logs).

Then, you can use Coraza's [`SecRuleRemoveById`](https://coraza.io/docs/seclang/directives/#secruleremovebyid) 
with that rule ID, along with a comment explaining why that rule is disabled 
and what the impact of that rule being disabled is.

That directive can be added in one of the two following files:

- For project-specific rules: `docker/caddy/coraza-project-overwrites.conf`.
- For all Eckinox projects: `docker/caddy/coraza-eckinox-overwrites.conf`
  - In this case, you should update the template's repository, so that other 
    projects can benefit from it.


Here's an example of a rule being removed, along with the impact of its removal:

```apache
# Allow all HTTP methods
SecRuleRemoveById 911100
```
