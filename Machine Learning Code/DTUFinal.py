# -*- coding: utf-8 -*-
"""
Created on Sat Feb 11 08:16:19 2017

@author: Devesh
"""

import pandas as pd
import warnings
warnings.filterwarnings('ignore')
import matplotlib.pyplot as plt


health=pd.read_csv("S:\Devesh\Downloads\Informations\Titanic\\HealthData.csv")

print(health.head())

health.drop("Id",axis=1,inplace=True)

print(health.head())

health["Temp"]=health.Temp.fillna(health["Temp"].median())
health["Pulse"]=health.Pulse.fillna(health["Pulse"].mean())

plt.scatter(health["Temp"][health["Ill"]==1],health["Pulse"][health["Ill"]==1],color="red",label="ILL")
plt.scatter(health["Temp"][health["Ill"]==0],health["Pulse"][health["Ill"]==0],color="blue",label="OK")
plt.xlabel("TEMP F")
plt.ylabel("PULSE")

plt.legend()
plt.show()

preds=["Temp","Pulse","Sex"]
train=health[preds]
targets=health["Ill"]

from sklearn.ensemble import ExtraTreesClassifier
from sklearn.ensemble import RandomForestClassifier
from sklearn.linear_model import LogisticRegression
from sklearn.ensemble import GradientBoostingClassifier, VotingClassifier
from sklearn import svm
from sklearn.cross_validation import cross_val_score
from sklearn.cross_validation import KFold
from sklearn.naive_bayes import GaussianNB
from sklearn.grid_search import RandomizedSearchCV
import sklearn as sk

#TESTING OUT DIFF ALGOS AND ENSEMBLE
"""
clf1=RandomForestClassifier(n_estimators=220,max_features="sqrt",random_state=1)
clf2=LogisticRegression(random_state=1)
clf3=svm.SVC(probability=True)
clf4=GaussianNB()
clf5=GradientBoostingClassifier(random_state=1)

for clf in [clf1,clf2,clf3,clf4,clf5]:
    scores=cross_val_score(clf, train, targets, cv=3, scoring='accuracy')
    clf.fit(train,targets)
    print(scores.mean())

print("Starting Stuff")

eclf = VotingClassifier(estimators=[('rnf', clf2), ('svc', clf3), ('gb', clf5)], voting='soft')

params={
        "svc__C":[0.025,0.1,0.3,0.5,0.7],
        "gb__max_depth":[2,3,5],
        "gb__n_estimators":[20,25,30,25]
        }

cv=sk.cross_validation.KFold(train.shape[0],n_folds=5,random_state=1)
random_search = RandomizedSearchCV(eclf, param_distributions=params,n_iter=4,cv=cv)
random_search.fit(train,targets)
print(random_search.grid_scores_)
print(random_search.best_score_)
"""

#BEST RESULT BY RANDOM FOREST
#CROSS VALIDATION SCORE ~82%

finalclf=RandomForestClassifier(n_estimators=220,max_features="sqrt",random_state=1)
finalclf.fit(train,targets)
finscore=cross_val_score(finalclf, train, targets, cv=3, scoring='accuracy')

print(finscore.mean())

import urllib,json

url="https://api.thingspeak.com/channels/225903/feeds.json?results=100"
jsonurl=urllib.request.urlopen(url).read().decode("UTF-8")
text=json.loads(jsonurl)


df=pd.DataFrame(text["feeds"])
df.drop("created_at",axis=1,inplace=True)
df.drop("entry_id",axis=1,inplace=True)
df.columns=["Temp","Pulse","Sex"]
df=df.head(1)

print(finalclf.predict(df))
