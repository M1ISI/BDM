// trouvé sur http://pastebin.com/fPMit0nL (i.e. source anonyme)
#include <cstdlib>
#include <cmath>
#include <climits>
#include <ctime>

#include <iostream>
using std::cout;
using std::cin;
using std::cerr;
using std::endl;

#include <fstream>
using std::ifstream;

#include <set>
using std::set;

#define MIN(x, y) (x) < (y) ? (x) : (y)
#define MAX(x, y) (x) > (y) ? (x) : (y)

/*
* TODO (mleyen 2014-04-01)
* Cet algorithme prend en paramètre deux fichiers contenant des séries de
* points. Il faut l'adapter pour qu'il prenne des fichiers .bmp si possible,
* ou trouver un moyen de générer ces séries de points.
*
* Aussi, il serait bon de remplacer la distance euclidienne par la distance
* hyperbolique, voir http://fr.wikipedia.org/wiki/Distance_hyperbolique
*/

struct Point
{
  double x;
  double y;

  Point(double _x, double _y)
  {
    x = _x;
    y = _y;
  }

  double distance(const Point &p) const
  {
    return sqrt( pow(x - p.x, 2) + pow(y - p.y, 2) );
  }

  bool operator <(const Point &p) const
  {
    if (x != p.x)
      return x < p.x;

    return y < p.y;
  }
};


double directedHausdorffDiscance(const set<Point> &p, const set<Point> &q)
{
  double h = 0.0;

  set<Point>::const_iterator pIt;
  set<Point>::const_iterator qIt;

  for (pIt = p.begin(); pIt != p.end(); ++pIt) {
    double shortest = INT_MAX;

    for (qIt = q.begin(); qIt != q.end(); ++qIt) {
      double dPQ = pIt->distance(*qIt);

      if (dPQ < shortest)
        shortest = dPQ;
    }

    if (shortest > h)
      h = shortest;
  }

  return h;
}

double hausdorffDiscance(set<Point> &p, set<Point> &q)
{
  double forward = directedHausdorffDiscance(p, q);
  double backward = directedHausdorffDiscance(q, p);

  return MAX(forward, backward);
}


int main(int argc, char **argv) {
  if (argc != 3)
  {
    cerr << "Uso: " << argv[0] << " p q" << endl;
    cerr << "\tp e q são arquivos com os conjuntos de pontos." << endl;

    return 1;
  }

  set<Point> p;
  set<Point> q;

  const char *pFilename = argv[1];
  const char *qFilename = argv[2];

  ifstream pFile(pFilename);

  if (!pFile)
  {
    cerr << "Erro ao abrir arquivo: " << pFilename << endl;

    return 1;
  }

  double x, y;

  while (pFile >> x >> y)
    p.insert(Point(x, y));

  pFile.close();

  ifstream qFile(qFilename);

  if (!qFile)
  {
    cerr << "Erro ao abrir o arquivo: " << pFilename << endl;

    return 1;
  }

  while (qFile >> x >> y)
    q.insert(Point(x, y));

  double h = hausdorffDiscance(p, q);

  cout << "Hausdorff distance = " << h << endl;

  return 0;
}