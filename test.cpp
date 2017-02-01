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
#include <Windows.h>

using namespace cv;
using namespace std;

//Global variables
Mat curFrame;   //current frame
int keyboard;   //input from keyboard

int const max_elem = 2;
int const max_kernel_size = 21;
int open_elem = 0;
int open_size = 0;

void processImages();
string generateFileName(int index);

int main()
{
	processImages();
	while (1);
	
	destroyAllWindows();
	return EXIT_SUCCESS;
}

void processImages() 
{

	namedWindow("Original", CV_WINDOW_NORMAL);
	namedWindow("Motion", CV_WINDOW_NORMAL);

	string fileName = generateFileName(304);

	Mat frame1 = imread(fileName);
	resize(frame1, frame1, Size(960, 540), (0, 0), (0, 0), cv::INTER_LINEAR);
	fileName = generateFileName(305);

	Mat frame2 = imread(fileName);
	resize(frame2, frame2, Size(960, 540), (0, 0), (0, 0), cv::INTER_LINEAR);
	fileName = generateFileName(306);

	Mat frame3 = imread(fileName);
	resize(frame3, frame3, Size(960, 540), (0, 0), (0, 0), cv::INTER_LINEAR);
	Mat motion;
	Mat motion2;
	absdiff(frame1, frame2, motion);
	absdiff(frame2, frame3, motion2);
	absdiff(motion, motion2, motion);
	threshold(motion, motion, 15, 255, THRESH_BINARY);
	morphologyEx(motion, motion, MORPH_OPEN, getStructuringElement(MORPH_RECT, Size(10, 10)));
	imshow("Original", frame1);
	imshow("Motion", motion);
	
	waitKey(100000);
}

string generateFileName(int index = 1)
{
	const string path = "C:\\Users\\Will\\Documents\\ImageProcessing\\DATA\\Woodpile road\\";
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