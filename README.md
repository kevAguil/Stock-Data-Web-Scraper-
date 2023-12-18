
# Web Scraping for Stock Data with PHP Display

This python program periodically downloads and extracts the information about the
most active stocks on NYSE (The New York Stock Exchange), and saves/updates the information
into a MongoDB database. Then, a PHP script is implemented to generate web pages to serve the information
through a web server upon user requests. This generates a table of stocks which can be sorted
in any order the user desires (eg. sorted by index, symbol, name, price, change, etc.)
