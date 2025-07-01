#include <stdio.h>

int main()
 {
    int n,i;
    char m ;
    printf("Enter the number of char: ");
    scanf("%d", &n);

    for (int i = n; i >= 1; i--)
        {
        for (m = 'A'; m < 'A' + i; m++)
        {

            printf("%c ", m);
        }
        printf("\n");
    }


}
