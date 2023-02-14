# HTTP 403 Unauthorized (firewall blocks requests)

If a request receives an `HTTP 403 Unauthorized` response, and you know your 
project's PHP code isn't triggering the error, the most likely explanation is 
that the firewall is blocking your request.

If that's the case, take a look at the Caddy logs and you'll see the errors. 

```log
project-php-1       | {"level":"error","ts":1666882916.7945118, ...
project-php-1       | {"level":"error","ts":1666882916.8085787, ...
project-php-1       | {"level":"error","ts":1666882916.8100588, ...
```


## How to solve the problem

If you look at these logs more closely, you'll see they contain more 
information about why the request was denied. 

Take a look at the `msg` property of each log, in order (top to bottom). Each
log contains clear indication on which rule was "broken" by the request, along
with information about the rule itself (ID, name, tags, etc.) and the request 
(URL, relevant data for the rule).

### Understanding how the rules work

Here's a over-simplified explanation of the firewall's process:

1. Each rule that analyzes your request runs in order.
  - If a rule detects something, that rule increases the "Anomaly Score" for 
    the request.
  - The number added to the Anomaly Score depends on the severity of the issue.
2. Then, other rules check if the request's Anomaly Score is too high.
  - If the anomaly score is too high is, it tells the web server to block the 
    request (aka: to return an HTTP 403 response).

**⚠️ Understanding this basic flow is very important,** because disabling one the
rules from Step 2 may disable the entire firewall.

**⚠️ You should NEVER disable one of the rules from Step 2.**

### Finding the problem in the logs

The first log is usually the one you'll want to look at, as the following logs 
are usually the rules that block the request when the Anomaly Score is too high.

When you take a look at the log's content, you should be able to identify what 
caused the issue.

Here's an example of logs for an SQL Injection attack (formatted to help you 
better see the information):

```log
[client "172.29.0.1"] Coraza: Warning. SQL Injection Attack Detected via libinjection 
	[file "/etc/caddy/coreruleset/rules/REQUEST-942-APPLICATION-ATTACK-SQLI.conf"] 
	[line "0"] 
	[id "942100"] 
	[rev ""] 
	[msg "SQL Injection Attack Detected via libinjection"] 
	[data "Matched Data: s&1 found within ARGS:_username: 1\\" OR 1 = 1"] 
	[severity "critical"] 
	[ver "OWASP_CRS/3.3.2"] 
	[maturity "0"] 
	[accuracy "0"] 
	[tag "application-multi"] [tag "language-multi"] [tag "platform-multi"] [tag "attack-sqli"] [tag "paranoia-level/1"] [tag "OWASP_CRS"] [tag "capec/1000/152/248/66"] [tag "PCI/6.5.2"] 
	[hostname ""] 
	[uri "/login"] 
	[unique_id "SBpVa0zZVcG9DiHQdXD"]
```
```log
[client "172.29.0.1"] Coraza: Warning. Inbound Anomaly Score Exceeded (Total Score: 20) 
	[file "/etc/caddy/coreruleset/rules/REQUEST-949-BLOCKING-EVALUATION.conf"] 
	[line "0"] 
	[id "949110"] 
	[rev ""] 
	[msg "Inbound Anomaly Score Exceeded (Total Score: 20)"] 
	[data ""] 
	[severity "critical"] 
	[ver "OWASP_CRS/3.3.2"] 
	[maturity "0"] 
	[accuracy "0"] 
	[tag "application-multi"] 
	[tag "language-multi"] 
	[tag "platform-multi"] 
	[tag "attack-generic"] 
	[hostname ""] 
	[uri "/login"] 
	[unique_id "SBpVa0zZVcG9DiHQdXD"]
```
```log
[client "172.29.0.1"] Coraza: Warning. Inbound Anomaly Score Exceeded (Total Inbound Score: 20 - SQLI=20,XSS=0,RFI=0,LFI=0,RCE=0,PHPI=0,HTTP=0,SESS=0): individual paranoia level scores: 20, 0, 0, 0 
	[file "/etc/caddy/coreruleset/rules/RESPONSE-980-CORRELATION.conf"] 
	[line "0"] 
	[id "980130"] 
	[rev ""] 
	[msg "Inbound Anomaly Score Exceeded (Total Inbound Score: 20 - SQLI=20,XSS=0,RFI=0,LFI=0,RCE=0,PHPI=0,HTTP=0,SESS=0): individual paranoia level scores: 20, 0, 0, 0"] 
	[data ""] 
	[severity "emergency"] 
	[ver "OWASP_CRS/3.3.2"] 
	[maturity "0"] 
	[accuracy "0"] 
	[tag "event-correlation"] 
	[hostname ""] 
	[uri "/login"] 
	[unique_id "SBpVa0zZVcG9DiHQdXD"]
```

As you can see, the last two logs state "Inbound Anomaly Score Exceeded".
These are not the logs you'll want to look at or disable.

The first log, however, does contain much more interesting information:
- The message clearly describes the problem (`SQL Injection Attack Detected via 
  libinjection`).
- The URL of the request is present (`[uri "/login"]`)
- The relevant data from the request is included (`[data "Matched Data: s&1 
  found within ARGS:_username: 1\\" OR 1 = 1"]`)
	- Here, you see the problematic data comes from an argument named `_username`,
    which contained the value `1" OR 1 = 1`.
- The ID of the rule is also present (`[id "942100"]`). 

So, now you know exactly why the firewall blocked the request. 

Let's see how you can prevent the issue in your project.

### Solving the issue

There are three ways of resolving this type of problem:

- Updating your application to prevent suspicious requests.
- Editing the rule.
- Disabling the rule.

#### Updating your application to prevent suspicious requests
If you can update your application to prevent it from sending a suspicious 
request, do it. This is the best way to prevent the issue, as it does not 
compromise your system's security, and is usually less complicated than 
editing the rule to account for your exceptions.

#### Editing the rule
If preventing the suspicious request isn't feasible, editing the rule to add
and exception is your next best option. 

[Learn how to edit a rule](/docs/usage/configuration/firewall.md#editing-a-rule).

#### Disabling the rule

Finally, if there's nothing to be done with more sensible solutions, disabling 
the rule entirely is always a possibility. However, this should be your last 
resort, as each rule you disable creates a vulnerability in your system.

[Learn how to disable a rule](/docs/usage/configuration/firewall.md#disabling-a-rule).
