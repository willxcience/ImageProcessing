#include <opencv2/highgui/highgui.hpp>
#include <opencv2/imgproc/imgproc.hpp>
#include <opencv2/core/core.hpp>
#include <opencv2/imgcodecs/imgcodecs.hpp>
#include <opencv2/imgproc.hpp>
#include <opencv2/videoio.hpp>
#include <opencv2/highgui.hpp>
#include <opencv2/video.hpp>

using namespace cv;
using namespace std;

//Global variables
Mat curFrame;   //current frame
int keyboard;   //input from keyboard

Ptr<BackgroundSubtractor> pMOG2;


int main()
{
	VideoCapture cap(0);
	if(!cap.isOpened())
	{
		return -1;
	}

    pMOG2 = createBackgroundSubtractorMOG2();

	bool stop = false;
	int i = 0;
	while(!stop) {
		cap>>curFrame;
        Mat res;
        flip(curFrame, res, 0);
		if (i>0)
			imshow("Camera",res);
		i++;
        char c = waitKey(10);
        if (c==27) break;
	}

	destroyAllWindows();
    return EXIT_SUCCESS;
}