import requests
from bs4 import BeautifulSoup
from pymongo import MongoClient
import time


#connect to MongoDB
client = MongoClient("mongodb://localhost:27017")
db = client["stock_database"]
collection = db["top_active_stocks"]

while (True):
    # sends http request to the website
    r = requests.get("https://finance.yahoo.com/most-active")

    # if the request is not a success (status code != 200), we retry getting the page
    if(r.status_code != 200):
        r = requests.get("https://finance.yahoo.com/most-active")
        if(r.status_code != 200):
            print("An error has occured.")
            exit


    soup = BeautifulSoup(r.text, "lxml")


    # list holding top stocks
    stocks_data = []

    for i in range(25):

        symbol = soup.tbody.contents[i].a.string # symbol
        name = soup.tbody.contents[i].contents[1].string # name
        price = soup.tbody.contents[i].contents[2].string # price
        change = soup.tbody.contents[i].contents[3].string # change
        volume = soup.tbody.contents[i].contents[5].string # volume

        print(symbol)
        print(name)
        print(price)
        print(change)
        print(volume)

        stocks_data.append({
            "Index" : i+1,
            "Symbol" : symbol,
            "Name" : name,
            "Price" : price,
            "Change" : change,
            "Volume" : volume
        })
    
    x = collection.insert_many(stocks_data)
    print (x)
    time.sleep(180)

