# Dynamic-Classifier-Experiment

### More info
http://jeremyheminger.com/article/programming-php-javascript-python-sqlite/dynamic-classifier-experiment

Like many programmers right now I am interested in machine learning etc...And, as usual, I like to kind of re-invent the wheel when I'm building things for myself. It's more fun for and I get to learn a bit more about what's actually happening.

So anyhoo, I am a bit hazy on the details but, I think that generally a classifier is something that is set in stone that the program learns from.

A set of samples that are pre-defined by the person based on what the program should learn.

I wanted to build something where the program had no classifiers at all. It would build them over time based on similarities in the data. Obviously it's necessary to have a set of rules to find the data. These would be akin to the nodes however, I am not using nodes to find my data as such.

My initial experiments have been successful. I can find letters and images and the results flatten out nicely over random noise.

This was the easy part...The hard part, I think, will be the classification. I am still not entirely sure how I will go about doing it. But, I have a few ideas.

### Database Schema
CREATE TABLE class (id integer primary key autoincrement,color varchar(7),active boolean);

CREATE TABLE data (iid int,cid int,pixel boolean,x int,y int,certainty tinyint);

CREATE TABLE icinfo (iid int, cid int,x int,y int);
