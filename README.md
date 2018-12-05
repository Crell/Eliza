# Eliza for PHP

This is a straight port of the Eliza chatbot therapist to PHP.

Based very closely on this Python implementation: https://www.smallsurething.com/implementing-the-famous-eliza-chatbot-in-python/

## CLI

The `main.php` file is a basic CLI that lets you talk to Eliza.

## Library

Alternatively, you can use the `Crell\Eliza` class as a library within another application.  The only API call is `analyze(string)`, which will return a string response from Eliza.

## License

This library is released under the MIT license.
