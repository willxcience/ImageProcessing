#include <opencv2/highgui/highgui.hpp>
#include <opencv2/imgproc/imgproc.hpp>
#include <opencv2/core/core.hpp>
#include <opencv2/imgcodecs/imgcodecs.hpp>
#include <opencv2/imgproc.hpp>
#include <opencv2/videoio.hpp>
#include <opencv2/highgui.hpp>
#include <opencv2/video.hpp>
#include <cv.hpp>
#include <opencv2/video/background_segm.hpp>

#include <iostream>

#include "mysql_connection.h"

#include <cppconn/driver.h>
#include <cppconn/exception.h>
#include <cppconn/resultset.h>
#include <cppconn/statement.h>

using namespace cv;
using namespace std;

//Global variables
Mat curFrame;     //current frame
int keyboard = 0; //input from keyboard

void processImages(char *argv[]);
string generateFileName(int index);
bool checkGrayscale(Mat src);

//main function
int main(int argc, char *argv[])
{
    try
    {

	processImages(argv);
    }
    catch (sql::SQLException &e)
    {
    }

    //destroyAllWindows();
    return EXIT_SUCCESS;
}

void processImages(char *argv[])
{
    sql::Driver *driver;
    sql::Connection *con;
    sql::Statement *stmt;

    /* Create a connection */
    driver = get_driver_instance();
    con = driver->connect("localhost", "root", "usbw");
    /* Connect to the MySQL test database */
    con->setSchema("test");

    stmt = con->createStatement();

    //namedWindow("Original", CV_WINDOW_NORMAL);
    //namedWindow("Motion", CV_WINDOW_NORMAL);

    const string path = "/var/www/html/uploads/";
    string names[3];
    names[0] = path + string(argv[1]);
    names[1] = path + string(argv[2]);
    names[2] = path + string(argv[3]);

    string fileName;
    Mat frames[3];
    Mat motion;
    Mat motion2;

    bool flag = 0;

    for (int index = 1; index < 4; index++)
    {
	int pixels = 0;
	//fileName = generateFileName(index);

	curFrame = imread(names[index - 1]);
	resize(curFrame, curFrame, Size(960, 540));

	//update the buffer
	int currIndex = (index - 1) % 3;
	frames[currIndex] = curFrame;

	if (currIndex == 2)
	{
	    absdiff(frames[0], frames[1], motion);
	    absdiff(frames[1], frames[2], motion2);
	    absdiff(motion, motion2, motion);
	    threshold(motion, motion, 15, 255, THRESH_BINARY);

	    //Morphology OPEN & CLOSE
	    morphologyEx(motion, motion, MORPH_OPEN, getStructuringElement(MORPH_RECT, Size(15, 15)));
	    morphologyEx(motion, motion, MORPH_CLOSE, getStructuringElement(MORPH_CROSS, Size(10, 10)));
	}

	//imshow("Original", curFrame);

	if (index > 2)
	{
	    Mat tmp;
	    cvtColor(motion, tmp, cv::COLOR_RGB2GRAY);
	    //imshow("Motion", motion);

	    pixels = countNonZero(tmp == 0);
	    pixels = 518400 - pixels;
	}

	cout << pixels << "   ";
	if (index > 2 && pixels < 1000)
	{
	    flag = 1;
	}

	checkGrayscale(curFrame);
    }

    if (flag == 1)
    {
	for (int i = 0; i < 3; i++)
	{
	    string command = "UPDATE upload SET animal = 0 WHERE name = \"" + string(argv[i+1]) + "\";";
	    cout << command << endl;
	    stmt->execute(command);
	}
    }

    cout << "end" << endl;
    delete stmt;
    delete con;
}

string generateFileName(int index = 1)
{
    const string path = "/var/www/html/uploads/";
    const string prefix = "IMG_";
    const string suffix = ".JPG";
    string name = path + prefix;

    int n = 0;
    for (int i = index; i > 9; i /= 10)
	n++;

    for (int i = 0; i < 3 - n; i++)
	name = name + '0';

    name = name + to_string(index) + suffix;

    return name;
}

int countPixels(Mat a)
{
    return countNonZero(a);
}

bool checkGrayscale(Mat src)
{
    Mat bgr[3];
    split(src, bgr); //split source

    cv::Mat diff = bgr[0] != bgr[1];

    bool eq = cv::countNonZero(diff == 255) <= 2600;
    return eq;
}
