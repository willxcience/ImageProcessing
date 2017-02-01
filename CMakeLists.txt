cmake_minimum_required(VERSION 3.7)

project( Background )

find_package(OpenCV 3.2.0 REQUIRED PATHS /usr/local/Cellar/opencv3/3.2.0/share/)

#print message
message(STATUS "OpenCV library status:")
message(STATUS "    version: ${OpenCV_VERSION}")
message(STATUS "    include path: ${OpenCV_INCLUDE_DIRS}")

add_executable( Background test.cpp )
include_directories( ${OpenCV_INCLUDE_DIRS})
target_link_libraries( Background ${OpenCV_LIBS} )