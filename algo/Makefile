
OPTS=-O3
LDFLAGS= -lm -pthread 
COMMON= 
CFLAGS=-Wall -Wfatal-errors 

CFLAGS+=$(OPTS)

COMMON+= -DOPENCV
CFLAGS+= -DOPENCV
LDFLAGS+= `pkg-config --libs opencv` 
COMMON+= `pkg-config --cflags opencv` 
LDFLAGS+= -lmysqlcppconn

Background: test.cpp
	g++ -std=c++11 -o Background test.cpp $(COMMON) $(CFLAGS)  $(LDFLAGS)
