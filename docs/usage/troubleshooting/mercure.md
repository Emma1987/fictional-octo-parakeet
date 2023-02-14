# Troubleshooting Mercure

## HTTP 401 Unauthorized errors

If you are running into 401 Unauthorized errors when using Mercure, the reason
is either:

- The topic(s) your configuration allow don't match the one(s) you're 
  subscribing to.
- Your JWT secret doesn't match the one in your Mercure Hub.

If you've recently changed your JWT secret, make sure you have re-built your
Docker image after this change, otherwise the Mercure Hub will still be using 
the old secret, causing 401 Unauthorized errors.

## References

For more help with troubleshooting Mercure issues, refer to the official 
[Mercure Troubleshooting documentation](https://mercure.rocks/docs/hub/troubleshooting).
