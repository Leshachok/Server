#include <iostream>
#include <string>

using namespace std;

class Human {

    string name;
    string surname;
    int age;

public:

Human(string name, string surname, int age){

    this->name = name;
    this->surname = surname;
    this->age = age;

}

void SetName(string name){
    this->name = name;
}

void SetSuranme(string surname){
    this->surname = surname;
}

void SetAge(int age){
    this->age = age;
}

string GetName(){
    return name;
}

string GetSurname(){
    return surname;
}

int GetAge(){
    return age;
}


};



int main(){


    Human Sasha_Nos("Sashka", "Nosyara", 12);
    cout << Sasha_Nos.GetName() << endl;
    
    
    
    
    return 0;
}