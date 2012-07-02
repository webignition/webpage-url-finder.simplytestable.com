webpage-url-finder.simplytestable.com
=====================================

Overview
---------

The source for http://webpage-url-finder.simplytestable.com, a web service
used by simplytestable.com to get a collection of unique URLs from a given
web page.

This is intended to be used by computers not people; this is intended to be used
in other programs which themselves might be used by people. People can use it too
if they're curious, but the interface is not tailored to their whims.

Usage
-----

###Request

Issue a HTTP GET request containing a `url` parameter where the given URL is of the page from which you want to extract a collection of unique URLs.

Let's say you want to a collection of unique URLs for http://example.com:

`GET http://webpage-url-finder.simplytestable.com/?url=http://example.com`

Or for http://stackoverflow.com/users/5343/jon-cram:

`GET http://webpage-url-finder.simplytestable.com/?url=http://stackoverflow.com/users/5343/jon-cram`

###Response

You'll get back a JSON array containing all unique URLs found at the given URL.

#### Example

`GET http://webpage-url-finder.simplytestable.com/?url=http://example.com`

```
[
    "http:\/\/example.com\/",
    "http:\/\/example.com\/domains\/",
    "http:\/\/example.com\/numbers\/",
    "http:\/\/example.com\/protocols\/",
    "http:\/\/example.com\/about\/",
    "http:\/\/example.com\/go\/rfc2606",
    "http:\/\/example.com\/about\/presentations\/",
    "http:\/\/example.com\/about\/performance\/",
    "http:\/\/example.com\/reports\/",
    "http:\/\/example.com\/domains\/root\/",
    "http:\/\/example.com\/domains\/int\/",
    "http:\/\/example.com\/domains\/arpa\/",
    "http:\/\/example.com\/domains\/idn-tables\/",
    "http:\/\/example.com\/abuse\/",
    "http:\/\/www.icann.org\/",
    "mailto:iana@iana.org?subject=General+website+feedback"
]
```