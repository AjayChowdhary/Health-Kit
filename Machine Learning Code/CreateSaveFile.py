# -*- coding: utf-8 -*-
"""
Created on Sat Feb 11 11:12:26 2017

@author: Devesh
"""

import pandas as pd
from sklearn.ensemble import RandomForestClassifier

health=pd.read_csv("S:\Devesh\Downloads\Informations\Titanic\\HealthData.csv")
health.drop("Id",axis=1,inplace=True)

preds=["Temp","Pulse","Sex"]
train=health[preds]
targets=health["Ill"]

finalclf=RandomForestClassifier(n_estimators=220,max_features="sqrt",random_state=1)
finalclf.fit(train,targets)

import urllib,json

url="https://api.thingspeak.com/channels/225903/feeds.json?results=100"
jsonurl=urllib.request.urlopen(url).read().decode("UTF-8")
text=json.loads(jsonurl)

df=pd.DataFrame(text["feeds"])
df.columns=["created_at","entry_id","Temp","Pulse","Sex"]

df.to_csv("HealthDataF.csv",index=False)

ans=finalclf.predict(df[preds])
df["Ill"]=ans

#df=pd.DataFrame([[10,20],[30,40]],columns=["A","B"])
dfjson=df.to_json(orient="records")
df.to_json("trialdf.json")